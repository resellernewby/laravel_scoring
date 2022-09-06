<?php

namespace App\Http\Livewire\Consumable;

use App\Models\Brand;
use App\Models\Consumable;
use App\Models\Subrack;
use App\Models\Tag;
use LivewireUI\Modal\ModalComponent;

class Edit extends ModalComponent
{
    public Consumable $inputs;
    public $brandLists;
    public $subrackLists;
    public $tagLists;
    public $tags;
    public $subracks;

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
        'inputs.lifetime.required' => 'Masa pakai harus diisi!'
    ];

    public function mount(Consumable $consumable)
    {
        $this->inputs = $consumable;
        $this->tags = $consumable?->tags->pluck('name', 'id');
        $this->subracks = $consumable?->subracks->pluck('name', 'id');
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
        return view('livewire.consumable.edit');
    }

    public function update()
    {
        $this->validate();
        $this->inputs->save();
        if (is_array($this->subracks) && count($this->subracks) > 0) {
            $this->inputs->subracks()->sync($this->subracks);
        }

        if (is_array($this->tags) && count($this->tags) > 0) {
            $this->inputs->tags()->sync($this->tags);
        }

        $this->emit('consumableTable');
        $this->closeModal();
        $this->notify('Item barang telah diupdate!');
    }
}
