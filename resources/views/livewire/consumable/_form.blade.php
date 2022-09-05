<div class="flex flex-col space-y-4">
    <x-input label="Nama barang" wire:model.lazy="inputs.name" :error="$errors->first('inputs.name')" />

    <x-select label="Merek" wire:model.lazy="inputs.brand_id" :list="$brandLists"
        :error="$errors->first('inputs.brand_id')" />

    <x-input label="Barcode" wire:model.lazy="inputs.barcode" :error="$errors->first('inputs.barcode')" />

    <x-input.money label="Harga item" leading-add-on="Rp" wire:model.lazy="inputs.item_price"
        :error="$errors->first('inputs.item_price')" />

    <x-input type="number" label="Masa pakai" wire:model.lazy="inputs.lifetime"
        :error="$errors->first('inputs.lifetime')" help-text="Masa pakai dalam bulan" />

    <x-textarea label="Deskripsi barang" wire:model.lazy="inputs.description"
        :error="$errors->first('inputs.description')" />
</div>
