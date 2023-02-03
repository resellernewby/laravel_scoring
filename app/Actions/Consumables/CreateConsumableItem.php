<?php

namespace App\Actions\Consumables;

use App\Models\Asset;
use App\Models\Order;
use App\Traits\Numeric;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\DB;

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
                    'qty' => $rack['qty']
                ]);

                $item->warehouses()->attach($rack['warehouse_id'], [
                    'qty' => $rack['qty'],
                    'price' => $input['asset']['current_price']
                ]);

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
                'date' => now()
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
                    $destination = storage_path('app/public/consumables/' . $filename);
                    $destination_thumb = storage_path('app/public/consumables/thumbnails/' . $filename_thumb);

                    Image::make($image->getRealPath())->resize(500, null, function ($constraint) {
                        $constraint->aspectRatio();
                    })->save($destination);

                    Image::make($image->getRealPath())->resize(150, null, function ($constraint) {
                        $constraint->aspectRatio();
                    })->save($destination_thumb);

                    $collectImage[] = [
                        'name' => $filename,
                        'path' => $destination,
                        'main' => ($key === 0 ? '1' : '0')
                    ];
                }

                $item->assetImages()->createmany($collectImage);
            }
        });
    }
}
