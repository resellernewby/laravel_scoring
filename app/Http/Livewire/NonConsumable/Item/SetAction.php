<?php

namespace App\Http\Livewire\NonConsumable\Item;

use App\Models\Asset;
use App\Models\NonConsumable;
use App\Models\Order;
use App\Models\Rack;
use App\Services\Setting;
use App\Traits\WarehouseList;
use Illuminate\Support\Facades\DB;
use LivewireUI\Modal\ModalComponent;

class SetAction extends ModalComponent
{
    use WarehouseList;

    public $nonConsumable;
    public $action;
    public $returned = [];
    public $warehouse_id;
    public int $rack_id;

    protected $rules = [
        'action' => 'required',
        'returned.returned_at' => 'required',
        'returned.condition' => 'required',
        'returned.description' => 'required',
    ];

    public function mount(NonConsumable $nonConsumable)
    {
        $this->nonConsumable = $nonConsumable;
    }

    public function render()
    {
        return view('livewire.non-consumable.item.set-action', [
            'conditionLists' => $this->conditionLists,
            'warehouseLists' => $this->warehouseLists,
            'rackLists' => $this->rackLists,
        ]);
    }

    public function update()
    {
        DB::transaction(function () {
            $user = $this->nonConsumable->user;
            $rackId = $this->action == 'returned' ? $this->rack_id : config('setting.rack_id_for_damaged');
            $condition = $this->action == 'returned' ? $this->returned['condition'] : 'bad';
            $this->nonConsumable->update([
                'current_status' => $this->action,
                'non_consumable_type' => Rack::class,
                'non_consumable_id' => $rackId,
                'used_end' => $this->action == 'returned' ? null : now(),
                'user' => $this->action == 'returned' ? config('setting.user_beginner') : null,
                'conditon' => $condition,
            ]);

            $this->nonConsumable->nonConsumableTransactions()->create([
                'nct_able_id' => $rackId,
                'nct_able_type' => Rack::class,
                'action' => $this->action,
                'user' => $this->action == 'returned' ? config('setting.user_beginner') : $user,
                'condition' => $condition,
            ]);

            $this->nonConsumable->returnedNonConsumables()->create([
                'rack_id' => $rackId,
                'returned_at' => $this->returned['returned_at'],
                'returned_by' => $user,
                'condition' => $condition,
                'description' => $this->returned['description'],
            ]);

            if ($this->action == 'returned') {
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
                'name' => $user,
                'status' => $this->action,
                'date' => $this->returned['returned_at'],
                'location' => Rack::with(['warehouse'])->where('id', $this->action == 'returned' ? $this->rack_id : config('setting.rack_id_for_damaged'))->first()?->warehouse?->name,
            ]);

            // Create Transaction
            $order->transactions()->create([
                'asset_id' => $this->nonConsumable->asset_id,
                'qty' => 1,
                'price' => $this->nonConsumable->price
            ]);
        });

        $this->emit('itemTable');
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
