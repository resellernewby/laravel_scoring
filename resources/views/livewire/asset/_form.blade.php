<div class="flex flex-col space-y-4">
    <x-input label="Nama asset" wire:model.lazy="inputs.name" :error="$errors->first('inputs.name')" />

    <x-select label="Status asset" wire:model.lazy="inputs.status_asset_id" :list="$statusLists"
        :error="$errors->first('inputs.status_asset_id')" />

    <x-select label="Merek" wire:model.lazy="inputs.brand_id" :list="$brandLists"
        :error="$errors->first('inputs.brand_id')" />

    <x-input label="Serial number" wire:model.lazy="inputs.serial" :error="$errors->first('inputs.serial')" />

    <x-input label="Barcode" wire:model.lazy="inputs.barcode" :error="$errors->first('inputs.barcode')" />

    <div class="grid grid-cols-2 gap-2">
        <x-input.money label="Harga beli" leading-add-on="Rp" wire:model.lazy="inputs.purchase_cost"
            :error="$errors->first('inputs.purchase_cost')" />

        <x-input.date label="Tanggal beli" wire:model.lazy="inputs.purchase_at"
            :error="$errors->first('inputs.purchase_at')" />
    </div>

    <x-select.single label="Lokasi penyimpanan" wire:model="subrack" :list="$subrackLists"
        :error="$errors->first('subrack')" />

    <x-select.multiple label="Tag" wire:model="tags" :list="$tagLists" :error="$errors->first('tags')" />

    <div x-data="{ isShowing: false }">
        <a href="#" x-on:click.prevent="isShowing = !isShowing" class="text-blue-700 font-medium"
            x-text="isShowing == false ? 'Tampilkan input lainnya' : 'Sembunyikan'"></a>
        <div x-show="isShowing" class="mt-4 flex flex-col space-y-4">
            <x-input.date label="Akhir garansi" wire:model.lazy="inputs.warranty_period"
                :error="$errors->first('inputs.warranty_period')" />

            <x-input type="number" label="Masa pakai" wire:model.lazy="inputs.lifetime"
                :error="$errors->first('inputs.lifetime')" help-text="Masa pakai dalam bulan" />

            <x-textarea label="Deskripsi barang" wire:model.debounce.lazy="inputs.description"
                :error="$errors->first('inputs.description')" />

            <x-input label="Digunakan oleh" wire:model.lazy="inputs.used_by"
                :error="$errors->first('inputs.used_by')" />

            <x-input.date label="Digunakan pada" wire:model.lazy="inputs.used_at"
                :error="$errors->first('inputs.used_at')" />

            <x-input.date label="Tanggal pinjam" wire:model.lazy="inputs.rent_at"
                :error="$errors->first('inputs.rent_at')" />

            <x-input.date label="Tanggal pengembalian" wire:model.lazy="inputs.rent_end"
                :error="$errors->first('inputs.rent_end')" />

        </div>
    </div>
</div>
