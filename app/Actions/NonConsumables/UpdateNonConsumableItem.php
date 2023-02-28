<?php

namespace App\Actions\NonConsumables;

use App\Models\Asset;
use App\Models\Order;
use App\Traits\Numeric;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class UpdateNonConsumableItem
{
    use Numeric;

    public function handle($id, $input)
    {
        DB::transaction(function () use ($id, $input) {
            $input['asset']['current_price'] = $this->getNumeric($input['asset']['current_price']);

            // Update Item
            $item = Asset::find($id);
            $item->update($input['asset']);

            // sync to category
            $item->tags()->syncWithoutDetaching($input['tag_ids']);

            // non consumable update specification
            $item->assetSpecifications()->delete();
            if (!empty($input['spec'])) {
                foreach ($input['spec'] as $spec) {
                    $item->assetSpecifications()->create($spec);
                }
            }

            //Save images
            if (!empty($input['images'])) {
                $collectImage = [];
                $directory = config('setting.asset.image.directory');
                if (!is_dir(Storage::path($directory))) {
                    mkdir(Storage::path($directory), 0755, true);
                }

                foreach ($input['images'] as $key => $image) {
                    $extension = $image->getClientOriginalExtension();
                    $filename = uniqid() . '.' . $extension;
                    $filename_thumb = str_replace(".{$extension}", "_thumb.{$extension}", $filename);
                    $destination = Storage::path("{$directory}/" . $filename);
                    $destination_thumb = Storage::path("{$directory}/" . $filename_thumb);

                    Image::make($image->getRealPath())->resize(config('setting.asset.image.width'), null, function ($constraint) {
                        $constraint->aspectRatio();
                    })->save($destination);

                    Image::make($image->getRealPath())->resize(config('setting.asset.image.thumbnail.width'), config('setting.asset.image.thumbnail.width'), function ($constraint) {
                        $constraint->aspectRatio();
                        $constraint->upsize();
                    })->save($destination_thumb);

                    $collectImage[] = [
                        'name' => $filename,
                        'main' => ($key === 0 ? true : false)
                    ];
                }

                $item->assetImages()->createmany($collectImage);
            }
        });
    }
}
