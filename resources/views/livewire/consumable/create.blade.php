<div>
    <x-modal form-action="store">
        <x-slot name="title">
            Tambah Barang
        </x-slot>

        <x-slot name="content">
            <div class="flex flex-col space-y-4">
                <x-input label="Nama barang" wire:model.defer="inputs.name" :error="$errors->first('inputs.name')" />

                <x-select label="Merek" wire:model="inputs.brand_id" :list="$brandLists"
                    :error="$errors->first('inputs.brand_id')" />

                <x-input label="Barcode" wire:model.defer="inputs.barcode" :error="$errors->first('inputs.barcode')" />

                <x-input.money label="Harga item" leading-add-on="Rp" wire:model.defer="inputs.item_price"
                    :error="$errors->first('inputs.item_price')" />

                <x-input type="number" label="Masa pakai" wire:model.defer="inputs.lifetime"
                    :error="$errors->first('inputs.lifetime')" help-text="Masa pakai dalam bulan" />

                <x-textarea label="Deskripsi barang" wire:model.debounce.defer="inputs.description"
                    :error="$errors->first('inputs.description')" />
            </div>
        </x-slot>

        <x-slot name="footer">
            <x-button.secondary wire:click="$emit('closeModal')" wire:loading.remove wire:target="store">
                Batal
            </x-button.secondary>
            <x-button.primary type="submit" wire:loading.remove wire:target="store" class="ml-2">
                Tambahkan
            </x-button.primary>
            <x-button.primary wire:loading.flex wire:target="store" class="inline-flex items-center" disabled>
                <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor"
                        d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                    </path>
                </svg>
                Processing..
            </x-button.primary>
        </x-slot>
    </x-modal>
</div>
