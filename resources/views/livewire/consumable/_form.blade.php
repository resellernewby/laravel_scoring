<div class="w-2/5 flex flex-col space-y-4">
    <x-input label="Nama barang" wire:model.lazy="inputs.name" :error="$errors->first('inputs.name')" />

    <x-select.multiple label="Kategori" wire:model="tags" :list="$tagLists" :error="$errors->first('tags')" />

    <div class="flex space-x-4">
        <div class="w-full">
            <x-select label="Merek" wire:model.lazy="inputs.brand_id" :list="$brandLists" :error="$errors->first('inputs.brand_id')" />
        </div>
        <div class="flex flex-col justify-end">
            <x-button.secondary onclick="Livewire.emit('openModal', 'brand.create')" class="flex items-center"
                title="Tambah merek baru">
                <x-icon.plus class="h-5 w-5" />
            </x-button.secondary>
        </div>
    </div>

    <div class="flex space-x-4">
        <div class="w-full">
            <x-select label="Suplier" wire:model.lazy="inputs.suplier_id" :list="$suplierLists" :error="$errors->first('inputs.suplier_id')" />
        </div>
        <div class="flex flex-col justify-end">
            <x-button.secondary onclick="Livewire.emit('openModal', 'suplier.create')" class="flex items-center"
                title="Tambah merek baru">
                <x-icon.plus class="h-5 w-5" />
            </x-button.secondary>
        </div>
    </div>

    <x-input.money label="Harga pcs" leading-add-on="Rp" wire:model.lazy="inputs.current_price" :error="$errors->first('inputs.current_price')" />

    <x-input label="Barcode" wire:model.lazy="inputs.barcode" :error="$errors->first('inputs.barcode')" />

    @foreach ($storages as $key => $input)
        <div wire:key="{{ $key }}" class="bg-gray-50 border-dashed border-2 border-indigo-600 rounded-md p-2">
            <x-select label="Gudang penyimpanan" wire:model.lazy="warehouse_ids.{{ $key }}" :list="$warehouseLists"
                :error="$errors->first('warehouse_ids.{{ $key }}')" />

            <div class="mt-4 flex items-center space-x-4">
                <div class="w-3/5">
                    <x-select label="Rak" wire:model.lazy="rack_id.{{ $key }}" :list="$rackLists[$key] ?? null"
                        :error="$errors->first('rack_id.{{ $key }}')" />
                </div>

                <div class="w-2/5">
                    <x-input type="number" label="Qty" wire:model.lazy="qty.{{ $key }}"
                        :error="$errors->first('qty.{{ $key }}')" />
                </div>
            </div>

            @if ($key > 0)
                <div class="text-right mt-4">
                    <x-button.primary wire:click.prevent="removeInput({{ $key }})"
                        class="text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 border-red-600">
                        <x-icon.o-trash class="h-5 w-5" />
                        <span>Hapus</span>
                    </x-button.primary>
                </div>
            @endif
        </div>
    @endforeach

    @if (!empty($warehouse_ids))
        <x-button.secondary wire:click.prevent="addInput"
            class="mt-2 w-full flex items-center justify-center space-x-2 bg-gray-100">
            <x-icon.plus class="h-5 w-5" />
            <span>Tambah penyimpanan</span>
        </x-button.secondary>
    @endif
</div>
<div class="w-3/5">
    <x-input.filepond label="Gambar (maks. 6 item)" wire:model.lazy="images" multiple allowImagePreview
        imagePreviewMaxHeight="200" allowFileTypeValidation acceptedFileTypes="['image/*']" allowFileSizeValidation
        maxFileSize="4mb" maxFiles="6" />
</div>
