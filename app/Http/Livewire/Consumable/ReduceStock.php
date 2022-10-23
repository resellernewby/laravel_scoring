<?php

namespace App\Http\Livewire\Consumable;

use App\Models\Consumable;
use App\Models\Location;
use LivewireUI\Modal\ModalComponent;

class ReduceStock extends ModalComponent
{
    public $consumable;
    public $inputs;

    protected $rules = [
        'inputs.qty' => 'required|max:4',
        'inputs.location_id' => 'required',
        'inputs.by' => 'nullable',
    ];

    protected $messages = [
        'inputs.qty.required' => 'Jumlah barang harus diisi!',
        'inputs.qty.max' => 'Jumlah barang terlalu besar',
        'inputs.location_id.required' => 'Lokasi penggunaan barang harus diisi!'
    ];

    public function mount(Consumable $consumable)
    {
        $this->consumable = $consumable;
        $this->locationLists = Location::pluck('name', 'id');
    }

    public function render()
    {
        return view('livewire.consumable.reduce-stock');
    }

    public function store()
    {
        $validatedData = $this->validate();
        $validatedData['inputs']['type'] = 'out';
        $validatedData['inputs']['qty'] = - ($validatedData['inputs']['qty']);

        $this->consumable->consumableTransactions()
            ->create($validatedData['inputs']);

        $this->emit('consumableTable');
        $this->closeModal();
        $this->notify('Jumlah barang berhasil diupdate');
    }

    public static function modalMaxWidth(): string
    {
        return 'md';
    }
}
