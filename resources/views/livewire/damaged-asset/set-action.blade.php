<div>
    <x-modal form-action="update">
        <x-slot name="title">
            <strong>{{ $nonConsumable->asset->name }}</strong> Serial Number
            <strong>{{ $nonConsumable->serial }}</strong>
        </x-slot>

        <x-slot name="content">
            <div class="flex flex-col space-y-4">
                <div>
                    <label class="text-base font-semibold leading-6 text-gray-900">Tindakan</label>
                    <p class="text-sm leading-5 text-gray-500">Tindakan apa yang akan diberikan pada barang?</p>
                    <fieldset class="mt-4">
                        <legend class="sr-only">Action</legend>
                        <div class="space-y-4">
                            @if ($nonConsumable->current_status != 'in_repair')
                                <x-input.radio label="Repair" wire:model.lazy="action" :error="$errors->first('action')" value="in_repair"
                                    help-text="Barang dalam perbaikan" />
                            @endif
                            <x-input.radio label="Sold" wire:model.lazy="action" :error="$errors->first('action')" value="sold"
                                help-text="Barang dijual" />
                            <x-input.radio label="Destroyed" wire:model.lazy="action" :error="$errors->first('action')"
                                value="destroyed" help-text="Barang dimusnahkan dari gudang" />
                            @if ($nonConsumable->current_status == 'in_repair')
                                <x-input.radio label="Simpan di stok" wire:model.lazy="action" :error="$errors->first('action')"
                                    value="returned" help-text="Barang sudah diperbaiki, dikembalikan ke stock" />
                            @endif
                        </div>
                    </fieldset>
                </div>

                <div>
                    <x-input.date label="Tanggal*" wire:model.lazy="date_at" :error="$errors->first('date_at')" />
                    @if ($errors->first('date_at'))
                        <div class="mt-1 text-red-500 text-sm">{{ $errors->first('date_at') }}</div>
                    @endif
                </div>

                @if ($action === 'in_repair')
                    <x-input label="Diperbaiki oleh*" wire:model.lazy="repair_by" :error="$errors->first('repair_by')" />
                @endif

                @if ($action === 'sold')
                    <x-input label="Dijual kepada*" wire:model.lazy="sold_to" :error="$errors->first('sold_to')" />
                    <x-input label="Dijual oleh*" wire:model.lazy="sold_by" :error="$errors->first('sold_by')" />
                    <x-input.money label="Harga jual*" leading-add-on="Rp" wire:model.lazy="sold_price"
                        :error="$errors->first('sold_price')" />
                @endif

                @if ($action === 'returned')
                    <x-select label="Kondisi barang*" wire:model.lazy="condition" :list="$conditionLists"
                        :error="$errors->first('condition')" />

                    <div class="flex items-center space-x-4">
                        <div class="w-1/2">
                            <x-select label="Warehouse*" wire:model.lazy="warehouse_id" :list="$warehouseLists"
                                :error="$errors->first('warehouse_id')" required />
                        </div>

                        <div class="w-1/2">
                            <x-select label="Rack*" wire:model.lazy="rack_id" :list="$rackLists" :error="$errors->first('rack_id')"
                                required />
                        </div>
                    </div>
                    <x-textarea label="Keterangan barang" wire:model.lazy="description" :error="$errors->first('description')" />
                @endif
            </div>
        </x-slot>

        <x-slot name="footer">
            <x-button.secondary wire:click="$emit('closeModal')" wire:loading.remove wire:target="update">
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
                Processing..
            </x-button.primary>
        </x-slot>
    </x-modal>
</div>
