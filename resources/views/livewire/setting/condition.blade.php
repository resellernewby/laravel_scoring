<div>
    <div class="mx-auto max-w-3xl py-10 px-4 sm:px-6 lg:py-12 lg:px-8">
        <h1 class="text-3xl font-bold tracking-tight text-blue-gray-900">Kondisi Barang</h1>

        <form wire:submit.prevent="store" class="divide-y-blue-gray-200 mt-6 space-y-8 divide-y">
            <div class="grid grid-cols-1 gap-y-6">
                <x-input.addon leading-add-on="Excellent" wire:model.lazy="conditions.excellent" :error="$errors->first('conditions.excellent')"
                    help-text="Kondisi sangat bagus" />

                <x-input.addon leading-add-on="Good" wire:model.lazy="conditions.good" :error="$errors->first('conditions.good')"
                    help-text="Kondisi bagus" />

                <x-input.addon leading-add-on="Poor" wire:model.lazy="conditions.poor" :error="$errors->first('conditions.poor')"
                    help-text="Kondisi kurang bagus tapi masih bisa digunakan" />

                <x-input.addon leading-add-on="Bad" wire:model.lazy="conditions.bad" :error="$errors->first('conditions.bad')"
                    help-text="Kondisi buruk dan tidak bisa digunakan/perlu perbaikan" />
            </div>

            <div class="flex justify-end pt-8">
                <x-button.primary type="submit" wire:loading.remove wire:target="update" class="ml-2">
                    Simpan
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
