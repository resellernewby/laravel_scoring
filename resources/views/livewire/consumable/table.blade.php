<div>
    <div class="-mx-4 my-10 shadow bg-white sm:-mx-6 md:mx-0 md:rounded-lg">
        <div class="sm:flex sm:space-x-4 sm:items-center sm:justify-between sm:px-6 sm:py-4 px-3 py-3.5">
            <!-- Search -->
            <div class="w-full sm:w-64">
                <label for="search" class="sr-only">Search</label>
                <div class="relative text-gray-500 focus-within:text-gray-600">
                    <div class="pointer-events-none absolute inset-y-0 left-0 pl-3 flex items-center">
                        <!-- Heroicon name: solid/search -->
                        <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                            aria-hidden="true">
                            <path fill-rule="evenodd"
                                d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                    <input wire:model="search"
                        class="block w-full bg-white py-2 pl-10 pr-3 border border-gray-200 rounded-md focus:text-gray-500 focus:border-transparent focus:ring-0 placeholder-gray-500 focus:placeholder-gray-200 sm:text-sm"
                        placeholder="Cari barang..." type="search">
                </div>
            </div>
            <div class="flex items-center space-x-2">
                <x-button.primary onclick="Livewire.emit('openModal', 'consumable.create')"
                    class="flex items-center bg-white">
                    <x-icon.plus class="h-4 w-4 mr-1" /> Create
                </x-button.primary>
            </div>
        </div>

        <x-table>
            <x-slot name="head">
                <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6">
                    Nama Barang
                </th>
                <th scope="col" class="hidden px-3 py-3.5 text-left text-sm font-semibold text-gray-900 lg:table-cell">
                    Merek
                </th>
                <th scope="col" class="hidden px-3 py-3.5 text-left text-sm font-semibold text-gray-900 lg:table-cell">
                    Harga pcs
                </th>
                <th scope="col" class="hidden px-3 py-3.5 text-left text-sm font-semibold text-gray-900 lg:table-cell">
                    Qty
                </th>
                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                    Gudang
                </th>
                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                    Tag
                </th>
                <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-6">
                    <span class="sr-only">Select</span>
                </th>
            </x-slot>
            <x-slot name="body">
                @forelse ($consumables as $consumable)
                <tr wire:loading.class.delay="opacity-50">
                    <td
                        class="relative py-4 pl-4 sm:pl-6 pr-3 text-sm {{ !$loop->first ? 'border-t border-transparent' : '' }}">
                        <div class="font-medium text-gray-900">
                            {{ $consumable->name }}
                        </div>
                        <div class="mt-1 flex flex-col text-gray-500 sm:block lg:hidden">
                            <span>{{ $consumable?->brand?->name }}/Rp{{ number_format($consumable->item_price)
                                }}</span>
                            <span class="hidden sm:inline"> · </span>
                            <span>{{ $consumable->consumable_transactions_sum_qty }}</span>
                        </div>
                        @if (!$loop->first)
                        <div class="absolute right-0 left-6 -top-px h-px bg-gray-200"></div>
                        @endif
                    </td>
                    <td
                        class="hidden px-3 py-3.5 text-sm text-gray-500 lg:table-cell {{ !$loop->first ? 'border-t border-gray-200' : '' }}">
                        {{ $consumable?->brand?->name }}
                    </td>
                    <td
                        class="hidden px-3 py-3.5 text-sm text-gray-500 lg:table-cell {{ !$loop->first ? 'border-t border-gray-200' : '' }}">
                        Rp{{ number_format($consumable->item_price) }}
                    </td>
                    <td
                        class="hidden px-3 py-3.5 text-sm text-gray-500 lg:table-cell {{ !$loop->first ? 'border-t border-gray-200' : '' }}">
                        {{ $consumable->consumable_transactions_sum_qty }}
                    </td>
                    <td class="px-3 py-3.5 text-sm text-gray-500 {{ !$loop->first ? 'border-t border-gray-200' : '' }}">
                        @foreach ($consumable->subracks as $subrak)
                        {{ $subrak->rack?->warehouse?->name }} ({{ $subrak->rack?->name .'/'. $subrak->name }}) <br>
                        @endforeach
                    </td>
                    <td
                        class="px-3 py-3.5 text-sm text-gray-500 lg:table-cell {{ !$loop->first ? 'border-t border-gray-200' : '' }}">
                        @foreach ($consumable->tags as $tag)
                        <span
                            class="inline-flex rounded-full bg-gray-100 px-2 text-xs font-semibold leading-5 text-gray-800">{{
                            $tag->name }}</span>
                        @endforeach
                    </td>
                    <td
                        class="relative py-3.5 pl-3 pr-4 sm:pr-6 text-right text-sm font-medium {{ !$loop->first ? 'border-t border-transparent' : '' }}">
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
