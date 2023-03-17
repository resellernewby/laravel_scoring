<div>
    <x-modal form-action="update">
        <x-slot name="title">
            Daftar barang <strong>{{ $asset->name }}</strong>
        </x-slot>

        <x-slot name="content">
            <div class="-mx-4 my-10 shadow bg-white sm:-mx-6 md:mx-0 md:rounded-lg">
                <div class="sm:flex sm:space-x-4 sm:items-center sm:justify-between sm:px-6 sm:py-4 px-3 py-3.5">
                    <!-- Search -->
                    <div class="flex space-x-2 w-full">
                        <div class="w-96">
                            <label for="search" class="sr-only">Search</label>
                            <div class="relative text-gray-500 focus-within:text-gray-600">
                                <div class="pointer-events-none absolute inset-y-0 left-0 pl-3 flex items-center">
                                    <x-icon.search class="h-5 w-5" />
                                </div>
                                <input wire:model.debounce.500ms="search"
                                    class="block w-full bg-white py-2 pl-10 pr-3 border border-gray-200 rounded-md focus:text-gray-500 focus:border-blue-500 focus:ring-blue-500 placeholder-gray-500 focus:placeholder-gray-200 sm:text-sm"
                                    placeholder="Cari serial, pengguna atau lainnya..." type="search">
                            </div>
                        </div>
                        <x-dropdown label="Filter" divider>
                            <x-select label="Status" wire:model.debounce.500ms="filters.status" :list="$lists['status']" />
                            <x-select label="Kondisi" wire:model.debounce.500ms="filters.condition" :list="$lists['conditions']" />
                        </x-dropdown>
                    </div>
                    <div class="flex items-center space-x-8 flex-shrink-0">
                        {{-- <x-input.checkbox label="Tampilkan barang rusak" wire:model.debounce.500ms="show_damaged"
                            value="damaged" /> --}}
                    </div>
                </div>

                <x-table>
                    <x-slot name="head">
                        <th scope="col"
                            class="hidden px-3 py-3.5 text-left text-sm font-semibold text-gray-900 lg:table-cell">
                            Serial Number
                        </th>
                        <th scope="col"
                            class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6">
                            Tanggal Beli
                        </th>
                        <th scope="col"
                            class="hidden px-3 py-3.5 text-left text-sm font-semibold text-gray-900 lg:table-cell">
                            Kondisi
                        </th>
                        <th scope="col" class="hidden px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                            Lokasi
                        </th>
                        <th scope="col" class="hidden px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                            Garansi
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
                                            class="w-14 h-14 rounded-md"
                                            alt="{{ $nonConsumable->asset->imageFirst?->name }}">
                                        <div>
                                            @if ($nonConsumable->serial)
                                                <span class="hover:text-indigo-700">{{ $nonConsumable->serial }}</span>
                                            @else
                                                <span class="text-red-700">Belum diinput</span>
                                            @endif
                                            <p class="mt-1 text-xs text-gray-500">
                                                Model: {{ $nonConsumable->asset->model }}
                                            </p>
                                        </div>
                                    </div>
                                    <div class="mt-1 flex flex-col text-gray-500 sm:block lg:hidden">
                                        <div>Rp{{ number_format($nonConsumable->price) }}</div>
                                        <div>Kondisi:
                                            <strong>{{ App\Services\Setting::condition($nonConsumable->condition) }}</strong>
                                        </div>
                                        <div>Status:
                                            <strong>{{ App\Services\Setting::status($nonConsumable->current_status) }}</strong>
                                        </div>
                                        <div>Lokasi:
                                            <strong>
                                                @if ($nonConsumable->nonConsumable?->warehouse?->name)
                                                    <span>{{ $nonConsumable->nonConsumable?->warehouse?->name }}</span>
                                                @else
                                                    <p class="font-semibold">{{ $nonConsumable->nonConsumable->name }}
                                                    </p>
                                                    <span class="font-normal">Oleh: {{ $nonConsumable->user }}</span>
                                                @endif
                                            </strong>
                                        </div>
                                    </div>
                                    @if (!$loop->first)
                                        <div class="absolute right-0 left-6 -top-px h-px bg-gray-200"></div>
                                    @endif
                                </td>
                                <td
                                    class="hidden px-3 py-3.5 text-sm text-gray-600 lg:table-cell font-semibold {{ !$loop->first ? 'border-t border-gray-200' : '' }}">
                                    <p>{{ $nonConsumable->purchase_date->isoFormat('D MMMM Y') }}</p>
                                    <span
                                        class="text-xs text-orange-500 font-bold">Rp{{ number_format($nonConsumable->price) }}</span>
                                </td>
                                <td
                                    class="hidden px-3 py-3.5 text-sm text-gray-500 lg:table-cell font-semibold {{ !$loop->first ? 'border-t border-gray-200' : '' }}">
                                    <p>{{ App\Services\Setting::condition($nonConsumable->condition) }}</p>
                                    <span
                                        class="font-normal">{{ App\Services\Setting::status($nonConsumable->current_status) }}</span>
                                </td>
                                <td
                                    class="hidden px-3 py-3.5 text-sm text-gray-500 lg:table-cell {{ !$loop->first ? 'border-t border-gray-200' : '' }}">
                                    @if ($nonConsumable->nonConsumable?->warehouse?->name)
                                        <span>{{ $nonConsumable->nonConsumable?->warehouse?->name }}</span>
                                    @else
                                        <p class="font-semibold">{{ $nonConsumable->nonConsumable->name }}</p>
                                        <span class="font-normal">Oleh: {{ $nonConsumable->user }}</span>
                                    @endif
                                </td>
                                <td
                                    class="hidden px-3 py-3.5 text-sm text-gray-500 lg:table-cell {{ !$loop->first ? 'border-t border-gray-200' : '' }}">
                                    @if ($nonConsumable->remaining_warranty === null)
                                        <span>Tanpa garansi</span>
                                    @else
                                        @if ($nonConsumable->remaining_warranty > 0)
                                            <p class="text-indigo-600"><span
                                                    class="font-semibold">{{ $nonConsumable->remaining_warranty }}</span>
                                                hari
                                                tersisa</p>
                                            <span
                                                class="text-indigo-500 text-xs">{{ $nonConsumable->warranty_provider }}</span>
                                        @else
                                            <span class="text-red-500">Expired</span>
                                        @endif
                                    @endif
                                </td>
                                <td
                                    class="relative py-3.5 pl-3 pr-4 sm:pr-6 text-sm font-medium {{ !$loop->first ? 'border-t border-transparent' : '' }}">
                                    @include('livewire.non-consumable.item._actions')
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
                                        <span class="font-medium py-8 text-cool-gray-400 text-xl">Data tidak
                                            ditemukan</span>
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
        </x-slot>

        <x-slot name="footer">
            <x-button.secondary wire:click="$emit('closeModal')">
                Close
            </x-button.secondary>
        </x-slot>
    </x-modal>
</div>
