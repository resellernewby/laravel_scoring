<div class="flex flex-col space-y-4">
    <x-input label="Nama barang" wire:model.lazy="inputs.name" :error="$errors->first('inputs.name')" />

    <x-select.multiple label="Lokasi penyimpanan" wire:model="subracks" :list="$subrackLists"
        :error="$errors->first('subracks')" />

    <div class="flex space-x-2">
        <div class="w-full">
            <x-select label="Merek" wire:model.lazy="inputs.brand_id" :list="$brandLists"
                :error="$errors->first('inputs.brand_id')" />
        </div>
        <div class="flex flex-col justify-end">
            <x-button.secondary onclick="Livewire.emit('openModal', 'brand.create')" class="flex items-center"
                title="Tambah merek">
                <x-icon.plus class="h-5 w-5" />
            </x-button.secondary>
        </div>
    </div>

    <x-input label="Barcode" wire:model.lazy="inputs.barcode" :error="$errors->first('inputs.barcode')" />

    <div class="grid grid-cols-2 gap-2">
        <x-input.addon-right type="number" label="Masa pakai" leading-add-on="Bulan" wire:model.lazy="inputs.lifetime"
            :error="$errors->first('inputs.lifetime')" help-text="Masa pakai dalam bulan" />

        <x-input.money label="Harga pcs" leading-add-on="Rp" wire:model.lazy="inputs.item_price"
            :error="$errors->first('inputs.item_price')" />
    </div>

    <x-select.multiple label="Tag" wire:model="tags" :list="$tagLists" :error="$errors->first('tags')" />

    <x-textarea label="Deskripsi barang" wire:model.lazy="inputs.description"
        :error="$errors->first('inputs.description')" />
</div>
