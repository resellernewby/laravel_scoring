<div>
    <div class="-mx-4 my-10 shadow bg-white sm:-mx-6 md:mx-0 md:rounded-lg">
        <form wire:submit.prevent="update">
            <div class="sm:flex sm:space-x-8 sm:justify-between sm:px-6 sm:py-4 px-3 py-3.5">
                <div class="w-2/5 flex flex-col space-y-4">
                    <x-input label="Nama barang*" wire:model.lazy="asset.name" :error="$errors->first('asset.name')" />

                    <x-input label="Model barang*" wire:model.lazy="asset.model" :error="$errors->first('asset.model')" />

                    <div class="flex space-x-4">
                        <div class="w-full">
                            <x-select label="Kategori*" wire:model.lazy="tag_ids" :list="$tagLists" :error="$errors->first('tag_ids')" />
                        </div>
                        <div class="flex flex-col mt-6">
                            <x-button.secondary onclick="Livewire.emit('openModal', 'tag.create')"
                                class="flex items-center" title="Tambah kategori baru">
                                <x-icon.plus class="h-5 w-5" />
                            </x-button.secondary>
                        </div>
                    </div>

                    <div class="flex space-x-4">
                        <div class="w-full">
                            <x-select label="Merek*" wire:model.lazy="asset.brand_id" :list="$brandLists"
                                :error="$errors->first('asset.brand_id')" />
                        </div>
                        <div class="flex flex-col mt-6">
                            <x-button.secondary onclick="Livewire.emit('openModal', 'brand.create')"
                                class="flex items-center" title="Tambah merek baru">
                                <x-icon.plus class="h-5 w-5" />
                            </x-button.secondary>
                        </div>
                    </div>

                    <div class="flex space-x-4">
                        <div class="w-full">
                            <x-select label="Suplier*" wire:model.lazy="asset.suplier_id" :list="$suplierLists"
                                :error="$errors->first('asset.suplier_id')" />
                        </div>
                        <div class="flex flex-col mt-6">
                            <x-button.secondary onclick="Livewire.emit('openModal', 'suplier.create')"
                                class="flex items-center" title="Tambah merek baru">
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
                            <x-button.secondary onclick="Livewire.emit('openModal', 'funds-source.create')"
                                class="flex items-center" title="Tambah sumber dana baru">
                                <x-icon.plus class="h-5 w-5" />
                            </x-button.secondary>
                        </div>
                    </div>

                    <x-input.money label="Harga pcs*" leading-add-on="Rp" wire:model.lazy="asset.current_price"
                        :error="$errors->first('asset.current_price')" />

                    <x-input label="Barcode*" wire:model.lazy="asset.barcode" :error="$errors->first('asset.barcode')" />

                    <div>
                        <x-input.date label="Tanggal beli" wire:model.lazy="asset.purchase_at" :error="$errors->first('asset.purchase_at')" />
                        @if ($errors->first('asset.purchase_at'))
                            <div class="mt-1 text-red-500 text-sm">{{ $errors->first('asset.purchase_at') }}</div>
                        @endif
                    </div>
                </div>
                <div class="w-3/5">
                    <x-input.filepond label="Gambar (maks. 6 item)" wire:model.lazy="images" multiple allowImagePreview
                        imagePreviewMaxHeight="200" allowFileTypeValidation acceptedFileTypes="['image/*']"
                        allowFileSizeValidation maxFileSize="4mb" maxFiles="6" :uploadedFiles="isset($uploadedFiles) ? $uploadedFiles : []" />

                    <div class="mt-8 space-y-2">
                        @foreach ($specifications as $k => $i)
                            <div class="flex space-x-4 bg-gray-50 rounded-md p-2">
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
            </div>
            <div class="px-6 py-4 text-right">
                <x-button.secondary link="{{ route('non-consumable.index') }}" wire:loading.remove wire:target="update">
                    Batal
                </x-button.secondary>
                <x-button.primary type="submit" wire:loading.remove wire:target="update" class="ml-2">
                    Update
                </x-button.primary>
                <x-button.primary wire:loading.flex wire:target="update" class="inline-flex items-center" disabled>
                    <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg"
                        fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                            stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor"
                            d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                        </path>
                    </svg>
                    Processing...
                </x-button.primary>
            </div>
        </form>
    </div>
</div>
