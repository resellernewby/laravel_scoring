<?php

namespace App\Actions\NonConsumables;

use App\Models\Asset;
use App\Models\Order;
use App\Models\Rack;
use App\Models\Suplier;
use App\Models\Warehouse;
use App\Traits\Numeric;
use Illuminate\Support\Facades\DB;

class AddStockNonConsumable
{
    use Numeric;

    public function handle($input)
    {
        DB::beginTransaction();
        try {
            $input['asset']['current_price'] = $this->getNumeric($input['asset']['current_price']);
            $input['nonconsumable']['price'] = $this->getNumeric($input['nonconsumable']['price']);
            $input['nonconsumable']['residual_value'] = $this->getNumeric(isset($input['nonconsumable']['residual_value']) ? $input['nonconsumable']['residual_value'] : 0);
            $input['nonconsumable']['condition'] = 'excellent';
            $input['nonconsumable']['user'] = config('setting.user_beginner');
            $input['nonconsumable']['current_status'] = 'in_stock';
            $input['nonconsumable']['non_consumable_type'] = Rack::class;

            // First Asset
            $item = Asset::with(['suplier', 'racks'])->find($input['asset_id']);
            $suplierName = $item->suplier->name;

            // Store to Warehouse and rack
            $sum_qty = 0;
            $warehouseId = [];
            $storedRacks = $item->racks->pluck('pivot.qty', 'id')->toArray();
            foreach ($input['rack'] as $rack) {
                $sum_qty += $rack['qty'];
                $warehouseId[] = $rack['warehouse_id'];

                // create non consumable item
                $input['nonconsumable']['non_consumable_id'] = $rack['id'];
                $nonConsumables = collect();
                for ($i = 1; $i <= $rack['qty']; $i++) {
                    $nonConsumables->push($item->nonConsumables()->create($input['nonconsumable']));
                }

                // Klo menambahkan ke rak yang sama
                if (isset($storedRacks[$rack['id']])) {
                    $item->racks()->updateExistingPivot($rack['id'], [
                        'qty' => ($rack['qty'] + $storedRacks[$rack['id']])
                    ]);

                    $item->warehouses()->syncWithoutDetaching($rack['warehouse_id']);

                    continue;
                }

                $item->racks()->attach($rack['id'], [
                    'qty' => $rack['qty']
                ]);

                $item->warehouses()->syncWithoutDetaching($rack['warehouse_id']);
            }

            // Create Order add stock from suplier
            if ($input['asset']['suplier_id'] != $item->suplier_id) {
                $suplier = Suplier::find($input['asset']['suplier_id']);
                $suplierName = $suplier->name;
            }

            $order = Order::create([
                'name' => $suplierName,
                'status' => 'add stock',
                'date' => $input['asset']['purchase_at'],
                'funds_source_id' => $input['asset']['funds_source_id'],
                'suplier_id' => $input['asset']['suplier_id'],
                'location' => Warehouse::find($warehouseId)->implode('name', ', ')
            ]);

            // Create Transaction add stock from suplier
            $item->transactions()->create([
                'order_id' => $order->id,
                'qty' => $sum_qty,
                'price' => $input['asset']['current_price']
            ]);

            // Update Current Price, Suplier, on Asset
            $input['asset']['qty'] = $item->qty + $sum_qty;
            $item->update($input['asset']);
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }

        return $nonConsumables;
    }
}
