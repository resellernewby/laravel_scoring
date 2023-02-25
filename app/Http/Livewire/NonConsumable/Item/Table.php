<?php

namespace App\Http\Livewire\NonConsumable\Item;

use App\Models\Asset;
use App\Models\Brand;
use App\Models\NonConsumable;
use App\Models\Tag;
use App\Models\Warehouse;
use Illuminate\Support\Facades\DB;
use Livewire\WithPagination;
use LivewireUI\Modal\ModalComponent;

class Table extends ModalComponent
{
    use WithPagination;

    public $asset;
    public $search = '';
    public $isDelete = false;
    public $filters = [
        'status' => '',
        'condition' => ''
    ];

    public function mount(Asset $asset)
    {
        $this->asset = $asset;
    }

    public function getRowsQueryProperty()
    {
        return NonConsumable::query()
            ->with([
                'asset' => [
                    'brand',
                    'imageFirst'
                ]
            ])
            ->when($this->search, fn ($query) => $query->search($this->search))
            ->when($this->filters['status'], fn ($query) => $query->where(
                'current_status',
                $this->filters['status']
            ))
            ->when($this->filters['condition'], fn ($query) => $query->where(
                'condition',
                $this->filters['condition']
            ))
            ->where('asset_id', $this->asset->id)
            ->latest('id');
    }

    public function getRowsProperty()
    {
        return $this->rowsQuery->paginate(10);
    }

    public function render()
    {
        return view('livewire.non-consumable.item.table', [
            'nonConsumables' => $this->rows,
            'lists' => $this->lists
        ]);
    }

    public function addCart($id)
    {
        $item = Asset::where('type', 'non-consumable')->find($id);
        if (!$item) {
            $this->notify('Data tidak ditemukan');
            return;
        }

        if ($item->cart()->where('user_id', auth()->id())->count() > 0) {
            $item->cart()->increment('qty');
        } else {
            $item->cart()->create([
                'user_id' => auth()->id(),
                'qty' => 1
            ]);
        }

        $this->emit('addToCart');
    }

    public function destroy(Asset $asset)
    {
        $this->isDelete = false;
        $count = $asset->nonConsumables()
            ->where('current_status', 'in use')->count();
        if ($count > 0) {
            $this->notify($asset->name . ' punya riwayat pemakaian, tidak bisa dihapus!', 'warning');
            return;
        }

        DB::transaction(function () use ($asset) {
            $asset->warehouses()->detach();
            $asset->racks()->detach();
            $asset->tags()->detach();
            $asset->nonConsumables()->delete();
            $asset->transactions()->delete();
            $asset->assetImages()->delete();
            $asset->assetSpecifications()->delete();
            $asset->delete();
        });

        $this->notify($asset->name . ' berhasil dihapus');
    }

    public function addMoreTags($asset)
    {
        $this->emit('openModal', 'tag.tagged-asset', ['asset' => $asset]);
    }

    public function getListsProperty()
    {
        return [
            'status' => [
                'in stock' => 'in stock',
                'in use' => 'in use',
                'damaged' => 'damaged'
            ],
            'conditions' => [
                'excellent' => 'Excellent',
                'good' => 'Good',
                'fair' => 'Fair',
                'bad' => 'Bad'
            ]
        ];
    }

    public static function closeModalOnClickAway(): bool
    {
        return false;
    }

    /**
     * Supported: 'sm', 'md', 'lg', 'xl', '2xl', '3xl', '4xl', '5xl', '6xl', '7xl'
     */
    public static function modalMaxWidth(): string
    {
        return '7xl';
    }
}
