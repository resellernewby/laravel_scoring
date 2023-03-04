<div>
    <div class="mx-auto max-w-3xl py-10 px-4 sm:px-6 lg:py-12 lg:px-8">
        <h1 class="text-3xl font-bold tracking-tight text-blue-gray-900">Umum</h1>

        <form wire:submit.prevent="store" class="divide-y-blue-gray-200 mt-6 space-y-8 divide-y">
            <div class="grid grid-cols-1 gap-y-6">
                <x-input label="Nama Instansi" wire:model.lazy="company_name" :error="$errors->first('company_name')" />

                {{-- <x-input.file-upload label="Logo" wire:model.lazy="logo" :error="$errors->first('logo')">
                    <img class="inline-block h-12 w-12 rounded-full"
                        src="https://images.unsplash.com/photo-1550525811-e5869dd03032?ixlib=rb-1.2.1&auto=format&fit=facearea&facepad=2.5&w=256&h=256&q=80"
                        alt="">
                </x-input.file-upload>

                <x-input.file-upload label="Favicon" wire:model.lazy="favicon" :error="$errors->first('favicon')">
                    <img class="inline-block h-12 w-12 rounded-full"
                        src="https://images.unsplash.com/photo-1550525811-e5869dd03032?ixlib=rb-1.2.1&auto=format&fit=facearea&facepad=2.5&w=256&h=256&q=80"
                        alt="">
                </x-input.file-upload> --}}
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
