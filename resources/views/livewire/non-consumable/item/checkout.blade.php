<div>
    <x-modal form-action="update">
        <x-slot name="title">
            <strong>{{ $nonConsumable->asset->name }}</strong> Serial Number
            <strong>{{ $nonConsumable->serial }}</strong>
        </x-slot>

        <x-slot name="content">
            <div class="flex flex-col space-y-4">
                <x-input label="Nama pengguna*" wire:model.lazy="user" :error="$errors->first('user')" />

                <div class="flex space-x-4 mt-4">
                    <div class="w-full">
                        <x-select label="Lokasi pengguna*" wire:model.lazy="location_id" placeholder="Pilih lokasi"
                            :list="$locationLists" :error="$errors->first('location_id')" />
                    </div>
                    <div class="flex flex-col mt-6">
                        <x-button.secondary onclick="Livewire.emit('openModal', 'location.create')"
                            class="flex items-center" title="Tambah lokasi baru">
                            <x-icon.plus class="h-5 w-5" />
                        </x-button.secondary>
                    </div>
                </div>
            </div>
        </x-slot>

        <x-slot name="footer">
            <x-button.secondary wire:click="$emit('closeModal')" wire:loading.remove wire:target="update">
                Batal
            </x-button.secondary>
            <x-button.primary type="submit" wire:loading.remove wire:target="update" class="ml-2">
                Checkout
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
