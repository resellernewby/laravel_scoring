<?php

namespace App\Http\Livewire\NonConsumable\Item;

use App\Models\NonConsumable;
use App\Services\Setting;
use Illuminate\Support\Facades\DB;
use LivewireUI\Modal\ModalComponent;

class SetAction extends ModalComponent
{
    public $nonConsumable;
    public $action;
    public $returned;

    public function mount(NonConsumable $nonConsumable)
    {
        $this->nonConsumable = $nonConsumable;
    }

    public function render()
    {
        return view('livewire.non-consumable.item.set-action', [
            'conditionLists' => $this->conditionLists
        ]);
    }

    public function update()
    {
        DB::transaction(function () {
            $this->nonConsumable->update([
                'current_status' => 'damaged'
            ]);

            $this->nonConsumable->nonConsumableTransactions()->create([
                'nct_able_id' => Setting::get('gudang_rusak_id'),
                'nct_able_type' => Setting::get('gedung_rusak_type'),
                'action' => 'set rusak',
                'user' => $this->nonConsumable->user,
                'condition' => 'bad'
            ]);
        });

        $this->emit('nonConsumableTable');
        $this->notify($this->nonConsumable->asset->name . ' dengan serial <strong>' . $this->nonConsumable->serial . '</strong> diset rusak');
    }

    public function getConditionListsProperty()
    {
        return json_decode(Setting::get('conditions'), true);
    }
}
