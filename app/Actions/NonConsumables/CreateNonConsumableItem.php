<?php

namespace App\Actions\NonConsumables;

use App\Models\Asset;
use App\Models\Order;
use App\Models\Rack;
use App\Models\Warehouse;
use App\Traits\Numeric;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class CreateNonConsumableItem
{
    use Numeric;

    public function handle($input)
    {
        DB::beginTransaction();
        try {
            $input['asset']['current_price'] = $this->getNumeric($input['asset']['current_price']);
            $input['asset']['type'] = 'non-consumable';
            $input['nonconsumable']['price'] = $this->getNumeric($input['nonconsumable']['price']);
            $input['nonconsumable']['residual_value'] = $this->getNumeric($input['nonconsumable']['residual_value']);
            $input['nonconsumable']['condition'] = 'excellent';
            $input['nonconsumable']['user'] = config('setting.user_beginner');
            $input['nonconsumable']['current_status'] = 'in_stock';
            $input['nonconsumable']['non_consumable_type'] = Rack::class;

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

                // create non consumable item
                $input['nonconsumable']['non_consumable_id'] = $rack['id'];
                $nonConsumables = collect();
                for ($i = 1; $i <= $rack['qty']; $i++) {
                    $nonConsumables->push(
                        $item->nonConsumables()->create($input['nonconsumable'])
                    );
                }

                $total_qty += $rack['qty'];
                $warehouseId[] = $rack['warehouse_id'];
            }

            // non consumable specification
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

            $item->increment('qty', $total_qty);
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }

        return $nonConsumables;
    }
}
