<div>
    <div class="-mx-4 my-10 shadow bg-white sm:-mx-6 md:mx-0 md:rounded-lg">
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
                            placeholder="Cari nama barang..." type="search">
                    </div>
                </div>
                <x-dropdown label="Filter" divider>
                    <x-select label="Type" wire:model.debounce.500ms="filters.type" :list="$typeLists" />
                    <div class="space-y-2 py-2">
                        <x-input type="date" label="Dari" wire:model.lazy="filters.start_date" />
                        <x-input type="date" label="Sampai" wire:model.lazy="filters.end_date" />
                    </div>
                    <x-select label="Merek" wire:model.debounce.500ms="filters.brand" :list="$brandLists" />
                    <x-select label="Lokasi" wire:model.debounce.500ms="filters.location" :list="$locationLists" />
                    <x-select label="Aksi" wire:model.debounce.500ms="filters.status" :list="$actionLists" />
                </x-dropdown>
            </div>
        </div>

        <x-table>
            <x-slot name="head">
                <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6">
                    Nama Barang
                </th>
                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900 lg:table-cell">
                    Aksi
                </th>
                <th scope="col"
                    class="hidden px-3 py-3.5 text-left text-sm font-semibold text-gray-900 lg:table-cell">
                    Qty
                </th>
                <th scope="col"
                    class="hidden px-3 py-3.5 text-left text-sm font-semibold text-gray-900 lg:table-cell">
                    Harga pcs
                </th>
                <th scope="col"
                    class="hidden px-3 py-3.5 text-left text-sm font-semibold text-gray-900 lg:table-cell">
                    Lokasi
                </th>
                <th scope="col"
                    class="hidden px-3 py-3.5 text-left text-sm font-semibold text-gray-900 lg:table-cell">
                    Tanggal
                </th>
            </x-slot>
            <x-slot name="body">
                @forelse ($transactions as $transaction)
                    <tr wire:key="transaction-{{ $transaction->id }}" wire:loading.class.delay="opacity-50">
                        <td
                            class="relative py-4 pl-4 sm:pl-6 pr-3 text-sm {{ !$loop->first ? 'border-t border-transparent' : '' }}">
                            <div class="flex items-center space-x-2 font-semibold text-gray-800">
                                <img src="{{ $transaction->asset->imageFirst?->image_thumb_url }}"
                                    class="w-14 h-14 rounded-md" alt="{{ $transaction->asset->imageFirst?->name }}">
                                <div>
                                    <a href="{{ route('consumable.show', $transaction->asset->id) }}"
                                        class="hover:text-indigo-700">{{ $transaction->asset->name }}</a>
                                    <p class="mt-1 text-sm text-gray-500">
                                        {{ $transaction->asset->brand->name }}
                                    </p>
                                </div>
                            </div>
                            <div class="mt-1 flex flex-col text-gray-500 sm:block lg:hidden">
                                <div>Qty: {{ $transaction->qty }}</div>
                                <div>Lokasi: {{ $transaction->order->location }}</div>
                                <div>Tanggal: {{ $transaction->order->date->isoFormat('D MMMM Y') }}</div>
                            </div>
                            @if (!$loop->first)
                                <div class="absolute right-0 left-6 -top-px h-px bg-gray-200"></div>
                            @endif
                        </td>
                        <td
                            class="px-3 py-3.5 text-sm text-gray-500 lg:table-cell {{ !$loop->first ? 'border-t border-gray-200' : '' }}">
                            <h6 class="text-gray-900">
                                {{ $transaction->order->status }}
                            </h6>
                            <p class="font-normal text-gray-500">{{ $transaction->order->name }}</p>
                        </td>
                        <td
                            class="hidden px-3 py-3.5 text-sm text-gray-500 lg:table-cell {{ !$loop->first ? 'border-t border-gray-200' : '' }}">
                            {{ $transaction->qty }}
                        </td>
                        <td
                            class="hidden px-3 py-3.5 text-sm text-orange-500 lg:table-cell font-semibold {{ !$loop->first ? 'border-t border-gray-200' : '' }}">
                            Rp{{ number_format($transaction->price) }}
                        </td>
                        <td
                            class="hidden px-3 py-3.5 text-sm text-gray-500 lg:table-cell {{ !$loop->first ? 'border-t border-gray-200' : '' }}">
                            {{ $transaction->order->location }}
                        </td>
                        <td
                            class="hidden px-3 py-3.5 text-sm text-gray-500 lg:table-cell {{ !$loop->first ? 'border-t border-gray-200' : '' }}">
                            {{ $transaction->order->date->isoFormat('D MMMM Y') }}
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
            {{ $transactions->links() }}
        </div>
    </div>
</div>
