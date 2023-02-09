<?php

namespace App\Http\Livewire\Consumable;

use App\Models\Asset;
use App\Models\Consumable;
use LivewireUI\Modal\ModalComponent;

class AddStock extends ModalComponent
{
    public $consumable;
    public $inputs = [];
    public $search;

    protected $rules = [
        'inputs.qty' => 'required|max:10',
        'inputs.purchase_cost' => 'required',
        'inputs.purchase_at' => 'nullable',
    ];

    protected $messages = [
        'inputs.qty.required' => 'Jumlah barang harus diisi!',
        'inputs.qty.max' => 'Jumlah barang terlalu besar',
        'inputs.purchase_cost.required' => 'Harga barang harus diisi!'
    ];

    public function mount(Consumable $consumable)
    {
        $this->consumable = $consumable;
    }

    public function render()
    {
        return view('livewire.consumable.add-stock');
    }

    public function store()
    {
        $validatedData = $this->validate();

        $this->consumable->consumableTransactions()
            ->create($validatedData['inputs']);

        $this->emit('consumableTable');
        $this->closeModal();
        $this->notify('Jumlah barang berhasil ditambahkan');
    }

    public function getItemsProperty()
    {
        #
    }

    public static function modalMaxWidth(): string
    {
        return 'md';
    }
}
