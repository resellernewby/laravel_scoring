<?php

namespace App\Actions\Consumables;

use App\Models\Asset;
use App\Models\Order;
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
            foreach ($input['rack'] as $rack) {
                $item->racks()->attach($rack['id'], [
                    'qty' => $rack['qty'],
                    'price' => $input['asset']['current_price']
                ]);

                $item->warehouses()->attach($rack['warehouse_id']);

                $total_qty += $rack['qty'];
            }

            // create consumable item
            $item->consumable()->create([
                'qty' => $total_qty,
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
                'date' => $input['purchase_at'],
                'funds_source_id' => $input['funds_source_id']
            ]);

            // create transaction from suplier
            $item->transactions()->create([
                'order_id' => $order->id,
                'qty' => $total_qty,
                'price' => $input['asset']['current_price']
            ]);

            //Save images
            if (!empty($input['images'])) {
                $collectImage = [];
                foreach ($input['images'] as $key => $image) {
                    $extension = $image->getClientOriginalExtension();
                    $filename = uniqid() . '.' . $extension;
                    $filename_thumb = str_replace(".{$extension}", "_thumb.{$extension}", $filename);
                    $directory = config('setting.consumable.image.directory');
                    $destination = Storage::path("{$directory}/" . $filename);
                    $destination_thumb = Storage::path("{$directory}/" . $filename_thumb);

                    Image::make($image->getRealPath())->resize(config('setting.consumable.image.width'), null, function ($constraint) {
                        $constraint->aspectRatio();
                    })->save($destination);

                    Image::make($image->getRealPath())->resize(config('setting.consumable.image.thumbnail.width'), config('setting.consumable.image.thumbnail.width'), function ($constraint) {
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
