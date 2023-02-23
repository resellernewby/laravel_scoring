<div>
    <div class="relative mt-1">
        <!-- Search -->
        <div class="mt-10 w-full shadow-sm md:rounded-lg">
            <label for="search" class="sr-only">Search</label>
            <div class="relative text-gray-500 focus-within:text-gray-600">
                <div class="pointer-events-none absolute inset-y-0 left-0 pl-3 flex items-center">
                    <x-icon.search class="h-5 w-5" />
                </div>
                <input wire:model.debounce.500ms="search"
                    class="block w-full bg-white py-2 pl-10 pr-3 border border-gray-300 rounded-md md:rounded-lg shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-1 focus:ring-indigo-500 placeholder-gray-500 focus:placeholder-gray-200 sm:text-sm"
                    placeholder="Cari nama barang, model atau barcode..." type="search">
            </div>
        </div>

        @if (count($assets) > 0)
            <ul wire:loading.delay.class="opacity-50"
                class="absolute z-10 mt-1 max-h-56 w-full overflow-auto rounded-md bg-white py-1 text-base shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none sm:text-sm"
                id="options" role="listbox">
                @foreach ($assets as $asset)
                    <li wire:key="asset-{{ $asset->id }}" wire:click="selected({{ $asset->id }})"
                        @if ($loop->last) id="last_record" @endif
                        class="relative group cursor-pointer select-none py-2 pl-3 pr-9 text-gray-900 hover:bg-indigo-600 hover:text-white"
                        role="option" tabindex="-1">
                        <div class="flex items-center">
                            <img src="{{ $asset->imageFirst?->image_thumb_url }}" alt="{{ $asset->imageFirst?->name }}"
                                class="h-14 w-14 flex-shrink-0 rounded">
                            <div class="ml-3">
                                <p class="truncate text-lg font-semibold text-gray-700 group-hover:text-white">
                                    {{ $asset->name }}</p>
                                <span class="truncate text-gray-500 group-hover:text-white">{{ $asset->barcode }}</span>
                            </div>
                        </div>
                    </li>
                @endforeach
            </ul>
        @else
            @if ($info)
                <ul wire:loading.delay.class="opacity-50"
                    class="absolute z-10 mt-1 max-h-56 w-full overflow-auto rounded-md bg-white py-1 text-base shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none sm:text-sm">
                    <li class="relative cursor-default select-none py-2 pl-3 pr-9 text-gray-900">
                        <div class="flex items-center">
                            <span class="ml-3 truncate">
                                @if (isset($search))
                                    Data tidak tersedia
                                @else
                                    Ketik untuk menampilkan data
                                @endif
                            </span>
                        </div>
                    </li>
                </ul>
            @endif
        @endif

        <div class="mt-4">
            <livewire:non-consumable.add-stock />
        </div>
    </div>

    <script>
        window.onscroll = function(ev) {
            if ((window.innerHeight + window.scrollY) >= document.body.offsetHeight) {
                window.livewire.emit('loadMore');
            }
        };
    </script>
</div>
