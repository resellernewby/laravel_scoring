<div>
    <div class="-mx-4 my-10 shadow bg-white sm:-mx-6 md:mx-0 md:rounded-lg">
        <div class="sm:flex sm:space-x-4 sm:items-center sm:justify-between sm:px-6 sm:py-4 px-3 py-3.5">
            <!-- Search -->
            <div class="flex space-x-2 w-full">
                <div class="w-96">
                    <label for="search" class="sr-only">Search</label>
                    <div class="relative text-gray-500 focus-within:text-gray-600">
                        <div class="pointer-events-none absolute inset-y-0 left-0 pl-3 flex items-center">
                            <!-- Heroicon name: solid/search -->
                            <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd"
                                    d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                    clip-rule="evenodd" />
                            </svg>
                        </div>
                        <input wire:model="search"
                            class="block w-full bg-white py-2 pl-10 pr-3 border border-gray-200 rounded-md focus:text-gray-500 focus:border-blue-500 focus:ring-blue-500 placeholder-gray-500 focus:placeholder-gray-200 sm:text-sm"
                            placeholder="Cari barang..." type="search">
                    </div>
                </div>
                <x-dropdown label="Filter" divider>
                    <x-select label="Status" wire:model.debounce.500ms="filters.status" :list="$statusLists" />
                    <div class="space-y-2 bg-gray-100 pb-2">
                        <span>Rentang tanggal</span>
                        <x-input.date label="Dari" wire:model.lazy="filters.start_date" />
                        <x-input.date label="Sampai" wire:model.lazy="filters.end_date" />
                    </div>
                    <x-select label="Merek" wire:model.debounce.500ms="filters.brand" :list="$brandLists" />
                </x-dropdown>
            </div>
            <div class="flex items-center space-x-2">
                {{-- <x-button.primary onclick="Livewire.emit('openModal', 'asset.create')"
                    class="flex items-center bg-white">
                    <x-icon.plus class="h-4 w-4 mr-1" /> Create
                </x-button.primary> --}}
            </div>
        </div>

        <x-table>
            <x-slot name="head">
                <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6">
                    Nama Barang
                </th>
                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                    Status
                </th>
                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                    Qty
                </th>
                <th scope="col" class="hidden px-3 py-3.5 text-left text-sm font-semibold text-gray-900 lg:table-cell">
                    Deskripsi
                </th>
                <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-6">
                    <span class="sr-only">Select</span>
                </th>
            </x-slot>
            <x-slot name="body">
                @php
                $stat = [
                'in' => 'Masuk',
                'out' => 'Keluar'
                ]
                @endphp
                @forelse ($consumables as $consumable)
                <tr wire:loading.class.delay="opacity-50">
                    <td
                        class="relative py-4 pl-4 sm:pl-6 pr-3 text-sm {{ !$loop->first ? 'border-t border-transparent' : '' }}">
                        <div class="font-medium text-gray-900">
                            {{ $consumable->consumable?->name }}
                        </div>
                        <div class="mt-1 flex flex-col text-gray-500 sm:block lg:hidden">
                            <span>{{ $stat[$consumable->type] }}</span>
                            <span class="hidden sm:inline"> · </span>
                            <span></span>
                        </div>
                        @if (!$loop->first)
                        <div class="absolute right-0 left-6 -top-px h-px bg-gray-200"></div>
                        @endif
                    </td>
                    <td
                        class="hidden px-3 py-3.5 text-sm text-gray-500 lg:table-cell {{ !$loop->first ? 'border-t border-gray-200' : '' }}">
                        {{ $stat[$consumable->type] }}
                    </td>
                    <td
                        class="hidden px-3 py-3.5 text-sm text-gray-500 lg:table-cell {{ !$loop->first ? 'border-t border-gray-200' : '' }}">
                        {{ $consumable->qty }}
                    </td>
                    <td
                        class="hidden px-3 py-3.5 text-sm text-gray-500 lg:table-cell {{ !$loop->first ? 'border-t border-gray-200' : '' }}">
                        @if ($consumable->type == 'in')
                        <div class="flex flex-col">
                            <span class="font-semibold">Harga: {{ number_format($consumable->purchase_cost) }}</span>
                            <span>Tgl beli: {{ date('m-d-Y', strtotime($consumable->purchase_at)) }}</span>
                        </div>
                        @else
                        <div class="flex flex-col">
                            <span class="font-semibold">Lokasi: {{ $consumable->location?->name }}</span>
                            <span>Oleh: {{ $consumable->by }}</span>
                        </div>
                        @endif
                    </td>
                    <td
                        class="relative py-3.5 pl-3 pr-4 sm:pr-6 text-right text-sm font-medium {{ !$loop->first ? 'border-t border-transparent' : '' }}">
                        {{-- @include('livewire.asset._actions') --}}
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
