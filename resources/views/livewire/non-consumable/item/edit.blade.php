<div>
    <x-modal form-action="update">
        <x-slot name="title">
            Edit Item {{ $inputs->asset->name }}
        </x-slot>

        <x-slot name="content">
            <div class="flex flex-col space-y-4">
                <x-input label="Serial Number*" wire:model.lazy="inputs.serial" :error="$errors->first('inputs.serial')" />

                @if ($inputs->current_status == 'in_use')
                    <x-input label="Pengguna" wire:model.lazy="inputs.user" :error="$errors->first('inputs.user')" />
                @endif

                {{-- <x-input.money label="Harga*" leading-add-on="Rp" wire:model.lazy="inputs.current_price"
                    :error="$errors->first('inputs.current_price')" /> --}}

                {{-- <div>
                    <x-input.date label="Tanggal beli" wire:model.lazy="inputs.purchase_date" :error="$errors->first('inputs.purchase_date')" />
                    @if ($errors->first('inputs.purchase_date'))
                        <div class="mt-1 text-red-500 text-sm">{{ $errors->first('inputs.purchase_date') }}</div>
                    @endif
                </div> --}}

                {{-- <x-input.addon-right label="Masa ekonomis*" wire:model.lazy="inputs.economic_age" leading-add-on="Bulan"
                    help-text="Masa ekonomis dalam bulan" :error="$errors->first('inputs.economic_age')" />

                <x-input.money label="Nilai residu" leading-add-on="Rp" wire:model.lazy="inputs.residual_value"
                    :error="$errors->first('inputs.residual_value')" help-text="Harga/nilai sisa aset yang sudah berakhir umur ekonomisnya" /> --}}

                <x-select label="Kondisi barang*" wire:model.lazy="inputs.condition" :list="$conditionLists"
                    :error="$errors->first('inputs.condition')" />

                {{-- <x-input.addon-right label="Masa garansi" wire:model.lazy="inputs.warranty_period"
                    leading-add-on="Bulan" help-text="Masa garansi dalam bulan" :error="$errors->first('inputs.warranty_period')" />

                <x-input label="Penyedia garansi" wire:model.lazy="inputs.warranty_provider" :error="$errors->first('inputs.warranty_provider')" /> --}}
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
