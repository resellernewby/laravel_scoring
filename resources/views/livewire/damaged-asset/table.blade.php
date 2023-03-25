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
                <div class="w-full lg:w-96">
                    <label for="search" class="sr-only">Search</label>
                    <div class="relative text-gray-500 focus-within:text-gray-600">
                        <div class="pointer-events-none absolute inset-y-0 left-0 pl-3 flex items-center">
                            <x-icon.search class="h-5 w-5" />
                        </div>
                        <input wire:model.debounce.500ms="search"
                            class="block w-full bg-white py-2 pl-10 pr-3 border border-gray-200 rounded-md focus:text-gray-500 focus:border-blue-500 focus:ring-blue-500 placeholder-gray-500 focus:placeholder-gray-200 sm:text-sm"
                            placeholder="Cari barang, model atau barcode..." type="search">
                    </div>
                </div>
                <x-dropdown label="Filter" divider>
                    <x-select label="Kategori" wire:model.debounce.500ms="filters.tag" :list="$tagLists" />
                    <x-select label="Merek" wire:model.debounce.500ms="filters.brand" :list="$brandLists" />
                </x-dropdown>
            </div>
        </div>

        <x-table>
            <x-slot name="head">
                <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6">
                    Nama Barang
                </th>
                <th scope="col"
                    class="hidden px-3 py-3.5 text-left text-sm font-semibold text-gray-900 lg:table-cell">
                    Model
                </th>
                <th scope="col"
                    class="hidden px-3 py-3.5 text-left text-sm font-semibold text-gray-900 lg:table-cell">
                    Harga beli
                </th>
                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                    Kategori
                </th>
                <th scope="col"
                    class="hidden px-3 py-3.5 text-center text-sm font-semibold text-gray-900 lg:table-cell">
                    Status
                </th>
                <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-6">
                    <span class="sr-only">Select</span>
                </th>
            </x-slot>
            <x-slot name="body">
                @forelse ($nonConsumables as $nonConsumable)
                    <tr wire:loading.class.delay="opacity-50" wire:key="nonconsumable-{{ $nonConsumable->id }}">
                        <td
                            class="relative py-4 pl-4 sm:pl-6 pr-3 {{ !$loop->first ? 'border-t border-transparent' : '' }}">
                            <div class="flex items-center space-x-2 font-semibold text-gray-800">
                                <img src="{{ $nonConsumable->asset->imageFirst?->image_thumb_url }}"
                                    class="w-14 h-14 rounded-md" alt="{{ $nonConsumable->asset->imageFirst?->name }}">
                                <div>
                                    <a href="{{ route('non-consumable.show', $nonConsumable->asset->id) }}"
                                        class="hover:text-indigo-700">{{ $nonConsumable->asset->name }}</a>
                                    <p class="mt-1 text-sm text-gray-500">
                                        {{ $nonConsumable->asset->brand->name }}
                                    </p>
                                </div>
                            </div>
                            <div class="mt-1 flex flex-col text-gray-500 sm:block lg:hidden">
                                <span>Rp{{ number_format($nonConsumable->price) }}</span>
                            </div>
                            @if (!$loop->first)
                                <div class="absolute right-0 left-6 -top-px h-px bg-gray-200"></div>
                            @endif
                        </td>
                        <td
                            class="hidden px-3 py-3.5 text-sm text-gray-500 lg:table-cell font-semibold {{ !$loop->first ? 'border-t border-gray-200' : '' }}">
                            {{ $nonConsumable->asset->model }}
                        </td>
                        <td
                            class="hidden px-3 py-3.5 text-sm text-orange-500 lg:table-cell font-semibold {{ !$loop->first ? 'border-t border-gray-200' : '' }}">
                            Rp{{ number_format($nonConsumable->price) }}
                        </td>
                        <td
                            class="px-3 py-3.5 text-sm text-gray-500 lg:table-cell {{ !$loop->first ? 'border-t border-gray-200' : '' }}">
                            @foreach ($nonConsumable->asset->tags as $tag)
                                <x-badge color="purple" text="{{ $tag->name }}" />
                            @endforeach
                        </td>
                        <td
                            class="hidden px-3 py-3.5 text-sm text-gray-500 text-center lg:table-cell {{ !$loop->first ? 'border-t border-gray-200' : '' }}">
                            <x-badge color="red" text="{{ $nonConsumable->current_status }}" />
                            <p>{{ $nonConsumable->returnedDamaged?->description }}</p>
                        </td>
                        <td
                            class="relative py-3.5 pl-3 pr-4 sm:pr-6 text-sm font-medium {{ !$loop->first ? 'border-t border-transparent' : '' }}">
                            @include('livewire.damaged-asset._actions')
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
            {{ $nonConsumables->links() }}
        </div>
    </div>
</div>
