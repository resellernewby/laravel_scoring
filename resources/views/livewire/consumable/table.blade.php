<div>
    <div class="-mx-4 my-10 shadow bg-white sm:-mx-6 md:mx-0 md:rounded-lg">
        @if (!empty($filters['stock']))
            <div class="sm:flex sm:items-center sm:px-6 sm:pt-4 px-3 pt-2">
                <x-badge color="purple" text="{{ $stockFilters[$filters['stock']] }}" wire:click="resetStock" remove />
            </div>
        @endif
        <div class="sm:flex sm:space-x-4 sm:items-center sm:justify-between sm:px-6 sm:py-4 px-3 py-3.5">
            <!-- Search -->
            <div class="flex space-x-2 w-full">
                <div class="lg:w-96">
                    <label for="search" class="sr-only">Search</label>
                    <div class="relative text-gray-500 focus-within:text-gray-600">
                        <div class="pointer-events-none absolute inset-y-0 left-0 pl-3 flex items-center">
                            <x-icon.search class="h-5 w-5" />
                        </div>
                        <input wire:model.debounce.500ms="search"
                            class="block w-full bg-white py-2 pl-10 pr-3 border border-gray-200 rounded-md focus:text-gray-500 focus:border-blue-500 focus:ring-blue-500 placeholder-gray-500 focus:placeholder-gray-200 sm:text-sm"
                            placeholder="Cari barang atau barcode..." type="search">
                    </div>
                </div>
                <x-dropdown label="Filter" divider>
                    <x-select label="Kategori" wire:model.debounce.500ms="filters.tag" :list="$lists['tags']" />
                    <x-select label="Merek" wire:model.debounce.500ms="filters.brand" :list="$lists['brands']" />
                    <x-select label="Gudang" wire:model.debounce.500ms="filters.warehouse" :list="$lists['warehouses']" />
                </x-dropdown>
            </div>
            <div class="flex items-center space-x-8">
                <livewire:consumable.cart-box />

                <x-button.primary link="{{ route('consumable.checkin') }}" class="flex whitespace-nowrap items-center">
                    <x-icon.plus class="h-4 w-4 mr-1" /> Check in
                </x-button.primary>
            </div>
        </div>

        <x-table>
            <x-slot name="head">
                <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6">
                    Nama Barang
                </th>
                <th scope="col"
                    class="hidden px-3 py-3.5 text-left text-sm font-semibold text-gray-900 lg:table-cell">
                    Barcode
                </th>
                <th scope="col"
                    class="hidden px-3 py-3.5 text-left text-sm font-semibold text-gray-900 lg:table-cell">
                    Harga pcs
                </th>
                <th scope="col"
                    class="hidden px-3 py-3.5 text-left text-sm font-semibold text-gray-900 lg:table-cell">
                    Qty
                </th>
                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                    Gudang
                </th>
                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                    Kategori
                </th>
                <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-6">
                    <span class="sr-only">Select</span>
                </th>
            </x-slot>
            <x-slot name="body">
                @forelse ($consumables as $consumable)
                    <tr wire:loading.class.delay="opacity-50">
                        <td
                            class="relative py-4 pl-4 sm:pl-6 pr-3 {{ !$loop->first ? 'border-t border-transparent' : '' }}">
                            <div class="flex items-center space-x-2 font-semibold text-gray-800">
                                <img src="{{ $consumable->imageFirst?->image_thumb_url }}" class="w-14 h-14 rounded-md"
                                    alt="{{ $consumable->imageFirst?->name }}">
                                <div>
                                    <a href="{{ route('consumable.show', $consumable->id) }}"
                                        class="hover:text-indigo-700">{{ $consumable->name }}</a>
                                    <p class="mt-1 text-sm text-gray-500">
                                        {{ $consumable->brand->name }}
                                    </p>
                                </div>
                            </div>
                            <div class="mt-1 flex flex-col text-gray-500 sm:block lg:hidden">
                                <span>Rp{{ number_format($consumable->current_price) }}</span>
                            </div>
                            @if (!$loop->first)
                                <div class="absolute right-0 left-6 -top-px h-px bg-gray-200"></div>
                            @endif
                        </td>
                        <td
                            class="hidden px-3 py-3.5 text-sm text-gray-500 lg:table-cell {{ !$loop->first ? 'border-t border-gray-200' : '' }}">
                            {{ $consumable->barcode }}
                        </td>
                        <td
                            class="hidden px-3 py-3.5 text-sm text-orange-500 lg:table-cell font-semibold {{ !$loop->first ? 'border-t border-gray-200' : '' }}">
                            Rp{{ number_format($consumable->current_price) }}
                        </td>
                        <td
                            class="hidden px-3 py-3.5 text-sm text-gray-500 lg:table-cell font-semibold {{ !$loop->first ? 'border-t border-gray-200' : '' }}">
                            {{ $consumable->qty }}
                        </td>
                        <td
                            class="px-3 py-3.5 text-sm text-gray-500 {{ !$loop->first ? 'border-t border-gray-200' : '' }}">
                            <div class="space-y-4">
                                @foreach ($consumable->racks as $rack)
                                    <div>
                                        <span class="text-sm font-semibold">{{ $rack->name }} (Qty:
                                            {{ $rack->pivot->qty }})</span>
                                        <p class="text-xs text-gray-500">
                                            {{ $rack->warehouse?->name }}
                                        </p>
                                    </div>
                                @endforeach
                            </div>
                        </td>
                        <td
                            class="px-3 py-3.5 text-sm text-gray-500 lg:table-cell {{ !$loop->first ? 'border-t border-gray-200' : '' }}">
                            @foreach ($consumable->tags as $tag)
                                <x-badge color="purple" text="{{ $tag->name }}" />
                            @endforeach
                        </td>
                        <td
                            class="relative py-3.5 pl-3 pr-4 sm:pr-6 text-sm font-medium {{ !$loop->first ? 'border-t border-transparent' : '' }}">
                            @include('livewire.consumable._actions')
                            @if (!$loop->first)
                                <div class="absolute right-6 left-0 -top-px h-px bg-gray-200"></div>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <x-table.cell colspan="6">
                            <div class="flex justify-center items-center space-x-2">
                                <x-icon.inbox class="h-8 w-8 text-cool-gray-400" />
                                <span class="font-medium py-8 text-cool-gray-400 text-xl">Data tidak ditemukan</span>
                            </div>
                        </x-table.cell>
                    </tr>
                @endforelse
            </x-slot>
        </x-table>

        <div class="sm:px-6 sm:py-4 px-3 py-3.5">
            {{ $consumables->links() }}
        </div>
    </div>
</div>
