<x-app-layout>
    <div class="pt-8 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="flex-1 text-2xl font-bold text-gray-900">Check-in Asset Habis Pakai</h1>

        <!-- Tab -->
        <div x-data="{ tab: window.location.hash ? window.location.hash : '#new-item' }" class="mt-5">
            <div class="sm:hidden">
                <label for="tabs" class="sr-only">Select a tab</label>
                <!-- Use an "onChange" listener to redirect the user to the selected tab URL. -->
                <select id="tabs" name="tabs"
                    class="block w-full rounded-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">

                    <option>Tambah Stok</option>

                    <option selected>Stok Baru</option>
                </select>
            </div>
            <div class="hidden sm:block">
                <div class="border-b border-gray-200">
                    <nav class="-mb-px flex space-x-8" aria-label="Tabs">
                        <!-- Current: "border-indigo-500 text-indigo-600", Default: "border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300" -->
                        <a href="#" x-on:click.prevent="tab='#add-stock'"
                            :class="{ 'border-indigo-500 text-indigo-600': (tab == '#add-stock') }"
                            class="border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 group inline-flex items-center py-4 px-1 border-b-2 font-medium text-sm"
                            aria-current="page">
                            <x-icon.squares-plus :class="{ 'text-indigo-500' : (tab == '#add-stock') }"
                                class="text-gray-400 group-hover:text-gray-500 -ml-0.5 mr-2 h-5 w-5" />
                            <span>Tambah Stok</span>
                        </a>

                        <a href="#" x-on:click.prevent="tab='#new-item'"
                            :class="{ 'border-indigo-500 text-indigo-600': (tab == '#new-item') }"
                            class="border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 group inline-flex items-center py-4 px-1 border-b-2 font-medium text-sm">
                            <x-icon.plus :class="{ 'text-indigo-500' : (tab == '#new-item') }"
                                class="text-gray-400 group-hover:text-gray-500 -ml-0.5 mr-2 h-5 w-5" />
                            <span>Barang Baru</span>
                        </a>
                    </nav>
                </div>
            </div>

            <div x-show="tab == '#add-stock'" x-cloak>
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
            </div>

            <div x-show="tab == '#new-item'" x-cloak>
                <livewire:consumable.create />
            </div>
        </div>
    </div>
</x-app-layout>
