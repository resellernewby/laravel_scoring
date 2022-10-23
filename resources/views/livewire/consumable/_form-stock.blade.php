<div class="flex flex-col space-y-4">
    <x-input type="number" label="Jumlah barang" min="1" wire:model.lazy="inputs.qty"
        :error="$errors->first('inputs.qty')" />

    <x-input.money label="Harga total" leading-add-on="Rp" wire:model.lazy="inputs.purchase_cost"
        :error="$errors->first('inputs.purchase_cost')" />

    <x-input.date label="Tanggal beli" wire:model.lazy="inputs.purchase_at"
        :error="$errors->first('inputs.purchase_at')" />
</div>
