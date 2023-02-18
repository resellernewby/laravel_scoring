<?php

namespace App\Http\Livewire\Tag;

use App\Models\Asset;
use App\Models\Tag;
use LivewireUI\Modal\ModalComponent;

class TaggedAsset extends ModalComponent
{
    public $asset;
    public $ids;

    protected $rules = [
        'ids' => 'required'
    ];

    protected $messages = [
        'ids.required' => 'Kategori belum dipilih'
    ];

    public function mount(Asset $asset)
    {
        $this->asset = $asset;
    }

    public function render()
    {
        return view('livewire.tag.tagged-asset', [
            'tagLists' => $this->tagLists
        ]);
    }

    public function store()
    {
        $this->validate();

        $this->asset->tags()->syncWithoutDetaching($this->ids);

        $this->emit('taggedToAsset');
        $this->closeModal();
        $this->notify('Kategori berhasil ditambahkan ke ' . $this->asset->name);
    }

    public function getTagListsProperty()
    {
        return Tag::oldest('name')->pluck('name', 'id');
    }

    public static function modalMaxWidth(): string
    {
        return 'md';
    }
}
