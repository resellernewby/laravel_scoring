<?php

namespace App\Http\Livewire\NonConsumable;

use App\Models\NonConsumable;
use Illuminate\Support\Collection;
use LivewireUI\Modal\ModalComponent;

class UpdateSerial extends ModalComponent
{
    public Collection $serials;
    public $limit = 10;
    public $total;
    public $nonConsumables;

    public function mount($nonConsumables)
    {
        $this->nonConsumables = $nonConsumables;
        $this->total = count($nonConsumables);
        $this->limit = $this->total > $this->limit ? $this->limit : $this->total;
        $this->serials = collect();

        for ($i = 1; $i <= $this->limit; $i++) {
            $this->serials[] = [
                'serial' => ''
            ];
        }
    }

    public function addInput()
    {
        $remaining = $this->total - $this->limit;
        $adder = 10;

        if ($remaining < $adder) {
            $adder = $remaining;
        }

        for ($i = 1; $i <= $adder; $i++) {
            $this->serials->push([
                'serial' => ''
            ]);
        }

        $this->limit += $adder;
    }

    public function render()
    {
        return view('livewire.non-consumable.update-serial');
    }

    public function update()
    {
        if ($this->serials->count() < $this->total) {
            $this->notify('Pastikan Serial Number lainnya di input', 'warning');
        }

        foreach ($this->serials as $key => $value) {
            NonConsumable::find($this->nonConsumables[$key]['id'])->update($value);
        }

        $this->emit('nonConsumableTable');
        $this->notify('Barang baru berhasil ditambahkan');
        return redirect()->route('non-consumable.index');
    }

    public static function closeModalOnClickAway(): bool
    {
        return false;
    }

    public static function closeModalOnEscape(): bool
    {
        return false;
    }
}
