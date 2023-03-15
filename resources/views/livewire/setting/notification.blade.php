<div>
    <div class="mx-auto max-w-3xl py-10 px-4 sm:px-6 lg:py-12 lg:px-8">
        <h1 class="text-3xl font-bold tracking-tight text-blue-gray-900">Notifikasi dan Ambang Batas</h1>

        <form wire:submit.prevent="store" class="divide-y-blue-gray-200 mt-6 space-y-8 divide-y">
            <div class="grid grid-cols-1 gap-y-6">
                <x-input type="number" min="1" label="Barang segera habis" wire:model.lazy="lowstock"
                    :error="$errors->first('lowstock')" help-text="Jumlah minimal barang dikatakan segera habis" />

                <div>
                    <x-input.time label="Jam pemberitahuan notifikasi" wire:model.lazy="notif_hour" :error="$errors->first('notif_hour')"
                        date-format="H:i" alt-format="H:i" />
                    @if ($errors->first('notif_hour'))
                        <div class="mt-1 text-red-500 text-sm">{{ $errors->first('notif_hour') }}</div>
                    @endif
                </div>
            </div>

            <div class="flex justify-end pt-8">
                <button type="button"
                    class="rounded-md border border-gray-300 bg-white py-2 px-4 text-sm font-medium text-blue-gray-900 shadow-sm hover:bg-blue-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">Cancel</button>
                <button type="submit"
                    class="ml-3 inline-flex justify-center rounded-md border border-transparent bg-blue-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">Save</button>
            </div>
        </form>
    </div>
</div>
