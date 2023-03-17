<div class="lg:w-2/5 flex flex-col space-y-4">
    <x-input label="Nama barang*" wire:model.lazy="asset.name" :error="$errors->first('asset.name')" />

    <x-input label="Model barang*" wire:model.lazy="asset.model" :error="$errors->first('asset.model')" />

    <div class="flex space-x-4">
        <div class="w-full">
            <x-select label="Kategori*" wire:model.lazy="tag_ids" :list="$tagLists" :error="$errors->first('tag_ids')" />
        </div>
        <div class="flex flex-col mt-6">
            <x-button.secondary onclick="Livewire.emit('openModal', 'tag.create')" class="flex items-center"
                title="Tambah kategori baru">
                <x-icon.plus class="h-5 w-5" />
            </x-button.secondary>
        </div>
    </div>

    <div class="flex space-x-4">
        <div class="w-full">
            <x-select label="Merek*" wire:model.lazy="asset.brand_id" :list="$brandLists" :error="$errors->first('asset.brand_id')" />
        </div>
        <div class="flex flex-col mt-6">
            <x-button.secondary onclick="Livewire.emit('openModal', 'brand.create')" class="flex items-center"
                title="Tambah merek baru">
                <x-icon.plus class="h-5 w-5" />
            </x-button.secondary>
        </div>
    </div>

    <div class="flex space-x-4">
        <div class="w-full">
            <x-select label="Suplier*" wire:model.lazy="asset.suplier_id" :list="$suplierLists" :error="$errors->first('asset.suplier_id')" />
        </div>
        <div class="flex flex-col mt-6">
            <x-button.secondary onclick="Livewire.emit('openModal', 'suplier.create')" class="flex items-center"
                title="Tambah merek baru">
                <x-icon.plus class="h-5 w-5" />
            </x-button.secondary>
        </div>
    </div>

    <div class="flex space-x-4">
        <div class="w-full">
            <x-select label="Sumber dana*" wire:model.lazy="asset.funds_source_id" :list="$fundsLists"
                :error="$errors->first('asset.funds_source_id')" />
        </div>
        <div class="flex flex-col mt-6">
            <x-button.secondary onclick="Livewire.emit('openModal', 'funds-source.create')" class="flex items-center"
                title="Tambah sumber dana baru">
                <x-icon.plus class="h-5 w-5" />
            </x-button.secondary>
        </div>
    </div>

    <x-input.money label="Harga pcs*" leading-add-on="Rp" wire:model.lazy="asset.current_price" :error="$errors->first('asset.current_price')" />

    <x-input label="Barcode*" wire:model.lazy="asset.barcode" :error="$errors->first('asset.barcode')" />

    <div>
        <x-input.date label="Tanggal beli" wire:model.lazy="asset.purchase_at" :error="$errors->first('asset.purchase_at')" />
        @if ($errors->first('asset.purchase_at'))
            <div class="mt-1 text-red-500 text-sm">{{ $errors->first('asset.purchase_at') }}</div>
        @endif
    </div>

    <x-input.addon-right type="number" label="Masa ekonomis" wire:model.lazy="nonconsumable.economic_age"
        leading-add-on="Bulan" help-text="Masa ekonomis dalam bulan" :error="$errors->first('nonconsumable.economic_age')" />

    <x-input.money label="Nilai residu" leading-add-on="Rp" wire:model.lazy="nonconsumable.residual_value"
        :error="$errors->first('nonconsumable.residual_value')" help-text="Harga/nilai sisa aset yang sudah berakhir umur ekonomisnya" />

    {{-- <div>
        <label class="block text-sm font-medium text-gray-700">Kondisi barang</label>
        <div class="mt-1 flex space-x-8 items-center">
            <x-input.radio label="Baru" wire:model.lazy="condition" value="new" :error="$errors->first('nonconsumable.condition')" />
            <x-input.radio label="Bekas" wire:model.lazy="condition" value="second" :error="$errors->first('nonconsumable.condition')" />
        </div>
    </div> --}}

    <x-input.addon-right type="number" label="Masa garansi" wire:model.lazy="nonconsumable.warranty_period"
        leading-add-on="Bulan" help-text="Masa garansi dalam bulan" :error="$errors->first('nonconsumable.warranty_period')" />

    <x-input label="Penyedia garansi" wire:model.lazy="nonconsumable.warranty_provider" :error="$errors->first('nonconsumable.warranty_provider')" />
</div>
<div class="lg:w-3/5">
    <x-input.filepond label="Gambar (maks. 6 item)" wire:model.lazy="images" multiple allowImagePreview
        imagePreviewMaxHeight="200" allowFileTypeValidation acceptedFileTypes="['image/*']" allowFileSizeValidation
        maxFileSize="4mb" maxFiles="6" :uploadedFiles="isset($uploadedFiles) ? $uploadedFiles : []" />

    <div class="space-y-2">
        @foreach ($storages as $key => $input)
            <div class="bg-gray-50 border-dashed border-2 border-indigo-600 rounded-md p-2"
                wire:key="storage-{{ $key }}">
                <x-select id="rack_{{ $key }}_warehouse_id" label="Gudang penyimpanan*"
                    wire:model.lazy="rack.{{ $key }}.warehouse_id" :list="$warehouseLists" :error="$errors->first('rack.{{ $key }}.warehouse_id')"
                    required />

                <div class="mt-4 flex items-center space-x-4">
                    <div class="w-3/5">
                        <x-select id="rack_{{ $key }}" label="Rak*"
                            wire:model.lazy="rack.{{ $key }}.id" :list="$rackLists[$key] ?? null" :error="$errors->first('rack.{{ $key }}.id')"
                            required />
                    </div>

                    <div class="w-2/5">
                        <x-input id="rack_{{ $key }}_qty" type="number" label="Qty*"
                            wire:model.lazy="rack.{{ $key }}.qty" :error="$errors->first('rack.{{ $key }}.qty')" required />
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

        <x-button.secondary wire:click.prevent="addInput"
            class="mt-2 flex items-center justify-center space-x-2 bg-gray-100" full>
            <x-icon.plus class="h-5 w-5" />
            <span>Tambah gudang</span>
        </x-button.secondary>
    </div>

    <div class="mt-8 space-y-2">
        @foreach ($specifications as $k => $i)
            <div class="flex space-x-4 bg-gray-50 rounded-md p-2" wire:key="spec-{{ $key }}">
                <div class="w-full">
                    <x-input id="spec{{ $k }}_name" label="Keterangan spesifikasi"
                        wire:model.lazy="spec.{{ $k }}.name" :error="$errors->first('spec.{{ $k }}.name')"
                        placeholder="mis. Berat" />
                </div>

                <div class="w-full">
                    <x-input id="spec_{{ $k }}_value" label="Isi keterangan"
                        wire:model.lazy="spec.{{ $k }}.value" :error="$errors->first('spec.{{ $k }}.value')"
                        placeholder="mis. 10 Kg" />
                </div>

                @if ($k > 0)
                    <div class="flex flex-col justify-end">
                        <x-button.primary wire:click.prevent="removeSpecInput({{ $k }})"
                            class="text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 border-red-600">
                            <x-icon.o-trash class="h-5 w-5" />
                        </x-button.primary>
                    </div>
                @endif
            </div>
        @endforeach

        <x-button.secondary wire:click.prevent="addSpecInput"
            class="mt-2 flex items-center justify-center space-x-2 bg-gray-100" full>
            <x-icon.plus class="h-5 w-5" />
            <span>Tambah spesifikasi</span>
        </x-button.secondary>
    </div>
</div>
