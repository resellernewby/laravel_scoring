<?php

namespace App\Http\Livewire\Consumable;

use App\Models\Brand;
use App\Models\Consumable;
use LivewireUI\Modal\ModalComponent;

class Create extends ModalComponent
{
    public $brandLists;
    public $inputs = [];

    protected $rules = [
        'inputs.name' => 'required|max:255',
        'inputs.brand_id' => 'required',
        'inputs.barcode' => 'nullable',
        'inputs.item_price' => 'required',
        'inputs.lifetime' => 'required',
        'inputs.description' => 'nullable'
    ];

    protected $messages = [
        'inputs.name.required' => 'Nama barang harus diisi!',
        'inputs.name.max' => 'Nama barang maksimal 255 karakter',
        'inputs.brand_id.required' => 'Merek barang harus dipilih!',
        'inputs.item_price.required' => 'Harga item harus diisi!',
        'inputs.lifetime' => 'Masa pakai harus diisi!'
    ];

    public function mount()
    {
        $this->brandLists = Brand::pluck('name', 'id');
    }

    public function render()
    {
        return view('livewire.consumable.create');
    }

    public function store()
    {
        $validatedData = $this->validate();
        Consumable::create($validatedData['inputs']);

        $this->emit('consumableTable');
        $this->closeModal();
        $this->notify('Barang baru berhasil ditambahkan');
    }
}
