<?php

namespace App\Http\Livewire\NonConsumable\Item;

use App\Models\NonConsumable;
use App\Services\Setting;
use LivewireUI\Modal\ModalComponent;

class Edit extends ModalComponent
{
    public NonConsumable $inputs;

    protected $rules = [
        'inputs.serial' => 'required|max:50',
        'inputs.user' => 'required|max:150',
        'inputs.condition' => 'required',
    ];

    protected $messages = [
        'inputs.serial.required' => 'Serial number harus diisi!',
        'inputs.serial.max' => 'Serial number lebih dari 50 karakter'
    ];

    public function mount(NonConsumable $nonConsumable)
    {
        $this->inputs = $nonConsumable;
    }

    public function render()
    {
        return view('livewire.non-consumable.item.edit', [
            'conditionLists' => $this->conditionLists
        ]);
    }

    public function update()
    {
        $this->validate();
        $this->inputs->save();

        $this->emit('itemTable');
        $this->closeModal();
        $this->notify('Barang berhasil diupdate');
    }

    public function getConditionListsProperty()
    {
        $data = Setting::get('conditions') ?? [];
        if (empty($data)) {
            return config('setting.conditions_returned');
        }

        $lists = json_decode($data, true);
        return $lists;
    }
}
