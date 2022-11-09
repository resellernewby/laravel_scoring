<?php

namespace App\Http\Livewire\Consumable;

use App\Models\Brand;
use App\Models\Consumable;
use App\Models\Subrack;
use App\Models\Tag;
use LivewireUI\Modal\ModalComponent;

class Create extends ModalComponent
{
    public $brandLists;
    public $tagLists;
    public $subrackLists;
    public $inputs = [];
    public $tags = [];
    public $subracks = [];

    protected $listeners = [
        'consumableCreate' => 'refreshBrand'
    ];

    protected $rules = [
        'inputs.name' => 'required|max:255',
        'inputs.brand_id' => 'required',
        'inputs.barcode' => 'nullable',
        'inputs.item_price' => 'required',
        'inputs.lifetime' => 'nullable',
        'inputs.description' => 'nullable'
    ];

    protected $messages = [
        'inputs.name.required' => 'Nama barang harus diisi!',
        'inputs.name.max' => 'Nama barang maksimal 255 karakter',
        'inputs.brand_id.required' => 'Merek barang harus dipilih!',
        'inputs.item_price.required' => 'Harga item harus diisi!'
    ];

    public function mount()
    {
        $this->brandLists = Brand::pluck('name', 'id');
        $this->tagLists = Tag::pluck('name', 'id');
        $subracks = Subrack::with('rack.warehouse')->get();
        $this->subrackLists = collect();
        foreach ($subracks as $subrack) {
            $this->subrackLists->put($subrack->id, "{$subrack?->rack?->warehouse?->name} ({$subrack?->rack->name} / {$subrack->name})");
        }
    }

    public function render()
    {
        return view('livewire.consumable.create');
    }

    public function store()
    {
        $validatedData = $this->validate();
        $consumable = Consumable::create($validatedData['inputs']);
        $consumable->subracks()->sync($this->subracks);

        if (count($this->tags) > 0) {
            $consumable->tags()->sync($this->tags);
        }

        $this->emit('consumableTable');
        $this->closeModal();
        $this->notify('Barang baru berhasil ditambahkan');
    }

    public function refreshBrand()
    {
        $this->brandLists = Brand::pluck('name', 'id');
    }
}
