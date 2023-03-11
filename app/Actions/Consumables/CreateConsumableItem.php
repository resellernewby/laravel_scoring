<?php

namespace App\Actions\Consumables;

use App\Models\Asset;
use App\Models\Order;
use App\Models\Warehouse;
use App\Traits\Numeric;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class CreateConsumableItem
{
    use Numeric;

    public function handle($input)
    {
        DB::transaction(function () use ($input) {
            $input['asset']['current_price'] = $this->getNumeric($input['asset']['current_price']);

            // Create Item
            $item = Asset::create($input['asset']);

            // asign to category
            $item->tags()->attach($input['tag_ids']);

            // asign to racks and warehouses
            $total_qty = 0;
            $warehouseId = [];
            foreach ($input['rack'] as $rack) {
                $item->racks()->attach($rack['id'], [
                    'qty' => $rack['qty']
                ]);

                $item->warehouses()->attach($rack['warehouse_id']);

                $total_qty += $rack['qty'];
                $warehouseId[] = $rack['warehouse_id'];
            }

            // create consumable item
            $item->consumable()->create([
                'lifetime' => $input['lifetime']
            ]);

            // consumable specification
            if (!empty($input['spec'])) {
                foreach ($input['spec'] as $spec) {
                    $item->assetSpecifications()->create($spec);
                }
            }

            // create order from suplier
            $order = Order::create([
                'name' => $item->suplier->name,
                'status' => 'new item',
                'date' => $input['asset']['purchase_at'],
                'funds_source_id' => $input['asset']['funds_source_id'],
                'suplier_id' => $input['asset']['suplier_id'],
                'location' => Warehouse::find($warehouseId)->implode('name', ', ')
            ]);

            // create transaction from suplier
            $item->transactions()->create([
                'order_id' => $order->id,
                'qty' => $total_qty,
                'price' => $input['asset']['current_price']
            ]);

            $item->update([
                'qty' => $total_qty,
            ]);

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
