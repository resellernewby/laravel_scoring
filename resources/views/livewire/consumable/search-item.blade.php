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
                    placeholder="Cari nama barang atau barcode..." type="search">
            </div>
        </div>

        @if (count($consumables) > 0)
            <ul wire:loading.delay.class="opacity-50"
                class="absolute z-10 mt-1 max-h-56 w-full overflow-auto rounded-md bg-white py-1 text-base shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none sm:text-sm"
                id="options" role="listbox">
                @foreach ($consumables as $consumable)
                    <li wire:key="consumable-{{ $consumable->id }}" wire:click="selected({{ $consumable->id }})"
                        @if ($loop->last) id="last_record" @endif
                        class="relative cursor-pointer select-none py-2 pl-3 pr-9 text-gray-900 hover:bg-indigo-600 hover:text-white"
                        role="option" tabindex="-1">
                        <div class="flex items-center">
                            <img src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80"
                                alt="" class="h-6 w-6 flex-shrink-0 rounded-full">
                            <span class="ml-3 truncate">{{ $consumable->name }}</span>
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
                                    Ketik untuk melihat data
                                @endif
                            </span>
                        </div>
                    </li>
                </ul>
            @endif
        @endif

        <div class="mt-4">
            <livewire:consumable.add-stock />
        </div>
    </div>

    <script>
        const lastRecord = document.getElementById('last_record');
        const options = {
            root: null,
            threshold: 1,
            rootMargin: '0px'
        }
        const observer = new IntersectionObserver((entries, observer) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    @this.loadMore()
                }
            });
        }, options);
        observer.observe(lastRecord);
    </script>
</div>
