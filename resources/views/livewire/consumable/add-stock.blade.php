<div>
    <!-- Search -->
    <div class="mt-10 w-full shadow-sm md:rounded-lg">
        <label for="search" class="sr-only">Search</label>
        <div class="relative text-gray-500 focus-within:text-gray-600">
            <div class="pointer-events-none absolute inset-y-0 left-0 pl-3 flex items-center">
                <x-icon.search class="h-5 w-5" />
            </div>
            <input wire:model="search"
                class="block w-full bg-white py-2 pl-10 pr-3 border border-gray-200 rounded-md md:rounded-lg focus:text-gray-500 focus:border-transparent focus:ring-0 placeholder-gray-500 focus:placeholder-gray-200 sm:text-sm"
                placeholder="Cari nama barang atau barcode..." type="search">
        </div>
    </div>

    <div></div>
</div>
