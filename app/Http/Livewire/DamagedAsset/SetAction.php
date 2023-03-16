<?php

namespace App\Http\Livewire\DamagedAsset;

use App\Models\Asset;
use App\Models\NonConsumable;
use App\Models\Order;
use App\Models\Rack;
use App\Services\Setting;
use App\Traits\Numeric;
use App\Traits\WarehouseList;
use Illuminate\Support\Facades\DB;
use LivewireUI\Modal\ModalComponent;

class SetAction extends ModalComponent
{
    use WarehouseList, Numeric;

    public $nonConsumable;
    public $action;
    public $warehouse_id;
    public int $rack_id;
    public $date_at;
    public $condition;
    public $description;
    public $repair_by;
    public $sold_to;
    public $sold_by;
    public $sold_price;

    protected $rules = [
        'action' => 'required',
        'date_at' => 'required',
        'description' => 'nullable|max:255',
    ];

    public function mount(NonConsumable $nonConsumable)
    {
        $this->nonConsumable = $nonConsumable;
    }

    public function render()
    {
        return view('livewire.damaged-asset.set-action', [
            'conditionLists' => $this->conditionLists,
            'warehouseLists' => $this->warehouseLists,
            'rackLists' => $this->rackLists,
        ]);
    }

    public function update()
    {
        DB::transaction(function () {
            $user = $this->nonConsumable->user;
            $rackId = $this->action === 'returned' ? $this->rack_id : config('setting.rack_id_for_damaged');
            $condition = $this->action === 'returned' ? $this->condition : 'bad';
            $this->sold_price = $this->getNumeric($this->sold_price);
            $usedEnd = $this->nonConsumable->used_end;
            $userable = [
                'returned' => config('setting.user_beginner'),
                'in_repair' => $this->repair_by,
                'sold' => $this->sold_by,
                'destroyed' => 'worker'
            ];

            $this->nonConsumable->update([
                'current_status' => $this->action,
                'non_consumable_type' => Rack::class,
                'non_consumable_id' => $rackId,
                'used_end' => $this->action === 'returned' ? null : $usedEnd,
                'user' => $userable[$this->action],
                'conditon' => $condition,
            ]);

            $this->nonConsumable->nonConsumableTransactions()->create([
                'nct_able_id' => $rackId,
                'nct_able_type' => Rack::class,
                'action' => $this->action,
                'user' => $userable[$this->action],
                'condition' => $condition,
            ]);

            if ($this->action === 'sold') {
                $this->nonConsumable->damagedNonConsumableSale()->create([
                    'sold_at' => $this->date_at,
                    'sold_to' => $this->sold_to,
                    'sold_by' => $this->sold_by,
                    'sold_price' => $this->sold_price,
                ]);
            }

            if ($this->action === 'returned') {
                $this->nonConsumable->returnedNonConsumables()->create([
                    'rack_id' => $rackId,
                    'returned_at' => $this->date_at,
                    'returned_by' => 'from damaged warehouse',
                    'condition' => $condition,
                    'description' => $this->description,
                ]);

                $asset = Asset::with(['racks'])->findOrFail($this->nonConsumable->asset_id);
                $storedRacks = $asset->racks->pluck('pivot.qty', 'id')->toArray();
                // Klo menambahkan ke rak yang sama
                if (isset($storedRacks[$this->rack_id])) {
                    $asset->racks()->updateExistingPivot($this->rack_id, [
                        'qty' => ($storedRacks[$this->rack_id] + 1)
                    ]);
                } else {
                    $asset->racks()->attach($this->rack_id, [
                        'qty' => 1
                    ]);

                    $asset->warehouses()->syncWithoutDetaching($this->warehouse_id);
                }

                $asset->increment('qty');
            }

            // Riwayat action
            $order = Order::create([
                'name' => $userable[$this->action],
                'status' => $this->action,
                'date' => $this->date_at,
                'location' => Rack::with(['warehouse'])->find($this->action == 'returned' ? $this->rack_id : config('setting.rack_id_for_damaged'))?->warehouse?->name,
            ]);

            // Create Transaction
            $order->transactions()->create([
                'asset_id' => $this->nonConsumable->asset_id,
                'qty' => 1,
                'price' => $this->nonConsumable->price
            ]);
        });

        $this->emit('damagedAssetTable');
        $this->closeModal();
        $this->notify($this->nonConsumable->asset->name . ' dengan serial <strong>' . $this->nonConsumable->serial . '</strong> telah ditindak');
    }

    public function getConditionListsProperty()
    {
        $data = Setting::get('conditions') ?? [];
        if (empty($data)) {
            return config('setting.conditions_returned');
        }

        $lists = json_decode($data, true);
        unset($lists['bad']);
        return $lists;
    }

    public function getRackListsProperty()
    {
        return Rack::where('warehouse_id', $this->warehouse_id)->pluck('name', 'id');
    }
}
