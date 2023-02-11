<div>
    @if ($asset)
        <div class="-mx-4 my-10 shadow bg-white sm:-mx-6 md:mx-0 md:rounded-lg">
            <form wire:submit.prevent="store">
                <div class="sm:flex sm:space-x-8 sm:justify-between sm:px-6 sm:py-4 px-3 py-3.5">
                    <div class="w-2/5 flex flex-col space-y-4">
                        <x-input label="Nama barang" value="{{ $asset->name }}" disabled />

                        <x-input label="Barcode" value="{{ $asset->barcode }}" disabled />

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

                        <x-input.money label="Harga pcs" leading-add-on="Rp" wire:model.lazy="asset.current_price"
                            :error="$errors->first('asset.current_price')" />

                        <div>
                            <x-input.date label="Tanggal beli" wire:model.lazy="purchase_at" :error="$errors->first('purchase_at')" />
                            @if ($errors->first('purchase_at'))
                                <div class="mt-1 text-red-500 text-sm">{{ $errors->first('purchase_at') }}</div>
                            @endif
                        </div>
                    </div>
                    <div class="w-3/5 flex flex-col space-y-4 pt-6">
                        @foreach ($storages as $key => $input)
                            <div class="bg-gray-50 border-dashed border-2 border-indigo-600 rounded-md p-2">
                                <x-select id="rack_{{ $key }}_warehouse_id" label="Gudang penyimpanan*"
                                    wire:model.lazy="rack.{{ $key }}.warehouse_id" :list="$warehouseLists"
                                    :error="$errors->first('rack.{{ $key }}.warehouse_id')" required />

                                <div class="mt-4 flex items-center space-x-4">
                                    <div class="w-3/5">
                                        <x-select id="rack_{{ $key }}" label="Rak*"
                                            wire:model.lazy="rack.{{ $key }}.id" :list="$rackLists[$key] ?? null"
                                            :error="$errors->first('rack.{{ $key }}.id')" required />
                                    </div>

                                    <div class="w-2/5">
                                        <x-input id="rack_{{ $key }}_qty" type="number" label="Qty*"
                                            wire:model.lazy="rack.{{ $key }}.qty" :error="$errors->first('rack.{{ $key }}.qty')"
                                            required />
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
                            class="mt-1 flex items-center justify-center space-x-2 bg-gray-100" full>
                            <x-icon.plus class="h-5 w-5" />
                            <span>Tambah gudang</span>
                        </x-button.secondary>
                    </div>
                </div>
                <div class="px-6 py-4 text-right">
                    <x-button.secondary wire:click="$emit('closeModal')" wire:loading.remove wire:target="store">
                        Batal
                    </x-button.secondary>
                    <x-button.primary type="submit" wire:loading.remove wire:target="store" class="ml-3">
                        Tambahkan
                    </x-button.primary>
                    <x-button.primary wire:loading.flex wire:target="store" class="inline-flex items-center" disabled>
                        <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg"
                            fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10"
                                stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor"
                                d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                            </path>
                        </svg>
                        Processing...
                    </x-button.primary>
                </div>
            </form>
        </div>
    @endif
</div>
