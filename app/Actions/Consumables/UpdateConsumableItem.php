<?php

namespace App\Actions\Consumables;

use App\Models\Asset;
use App\Models\Order;
use App\Traits\Numeric;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class UpdateConsumableItem
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

            // asign to racks and warehouses
            $total_qty = 0;
            foreach ($input['rack'] as $rack) {
                $currentQty = $item->racks()->find($rack['id'])->pivot->qty - $rack['qty'];
                $item->racks()->syncWithPivotValues($rack['id'], [
                    'qty' => $rack['qty']
                ]);

                $item->warehouses()->sync($rack['warehouse_id']);

                $total_qty += $currentQty;
            }

            // Update consumable item
            $item->consumable()->update([
                'qty' => $total_qty,
                'lifetime' => $input['lifetime']
            ]);

            // consumable update specification
            $item->assetSpecifications()->delete();
            if (!empty($input['spec'])) {
                foreach ($input['spec'] as $spec) {
                    $item->assetSpecifications()->create($spec);
                }
            }

            if ($total_qty != 0) {
                // create order from updater
                $order = Order::create([
                    'name' => auth()->user()->name,
                    'status' => 'update item',
                    'date' => $input['asset']['purchase_at'],
                    'funds_source_id' => $input['asset']['funds_source_id'],
                    'suplier_id' => $input['asset']['suplier_id']
                ]);

                // create transaction from updater
                $item->transactions()->create([
                    'order_id' => $order->id,
                    'qty' => $total_qty,
                    'price' => $input['asset']['current_price']
                ]);
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
