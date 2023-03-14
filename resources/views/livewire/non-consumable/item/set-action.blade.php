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
                            <x-input.radio label="Rusak" wire:model.lazy="action" :error="$errors->first('action')" value="damaged"
                                help-text="Barang akan disimpan didaftar barang rusak" />
                            <x-input.radio label="Dikembalikan" wire:model.lazy="action" :error="$errors->first('action')"
                                value="returned" help-text="Barang akan dikembalikan ke stock" />
                        </div>
                    </fieldset>
                </div>

                <div>
                    <x-input.date label="Tanggal*" wire:model.lazy="returned.returned_at" :error="$errors->first('returned.returned_at')" />
                    @if ($errors->first('returned.returned_at'))
                        <div class="mt-1 text-red-500 text-sm">{{ $errors->first('returned.returned_at') }}</div>
                    @endif
                </div>

                @if ($action === 'returned')
                    <x-select label="Kondisi barang*" wire:model.lazy="returned.condition" :list="$conditionLists"
                        :error="$errors->first('returned.condition')" />

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
                @endif

                <x-textarea label="Keterangan barang" wire:model.lazy="returned.description" :error="$errors->first('returned.description')" />
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
