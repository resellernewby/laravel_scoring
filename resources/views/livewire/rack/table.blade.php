<div>
    <div class="-mx-4 my-10 shadow bg-white sm:-mx-6 md:mx-0 md:rounded-lg">
        <div class="sm:flex sm:space-x-4 sm:items-center sm:justify-between sm:px-6 sm:py-4 px-3 py-3.5">
            <!-- Search -->
            <div class="w-full sm:w-64">
                Daftar Rak di <strong>{{ $warehouse->name }}</strong>
            </div>
            <div class="flex items-center space-x-2">
                <x-button.primary
                    onclick="Livewire.emit('openModal', 'warehouse.add-rack', {{ json_encode(['warehouse' => $warehouse->id]) }})"
                    class="flex items-center bg-white">
                    <x-icon.plus class="h-4 w-4 mr-1" /> Create
                </x-button.primary>
            </div>
        </div>

        <x-table>
            <x-slot name="head">
                <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6">
                    Nama rak
                </th>
                <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-6">
                    <span class="sr-only">Select</span>
                </th>
            </x-slot>
            <x-slot name="body">
                @forelse ($warehouse->racks as $rack)
                <tr wire:loading.class.delay="opacity-50">
                    <td class="relative py-4 pl-4 sm:pl-6 pr-3 text-sm">
                        <div x-data="{ open: false }">
                            <div @click="open = !open" class="flex items-center mb-1">
                                <x-icon.o-chevron-down x-show="open" class="h-5 w-5" />
                                <x-icon.o-chevron-right x-show="!open" class="h-5 w-5" />
                                <p class="font-medium text-gray-900">
                                    {{ $rack->name }} <span class="text-gray-500">({{ $rack->description }})</span>
                                </p>
                            </div>
                            <div x-show.transition.in.duration.800ms="open" class="border rounded-md p-4" x-cloak>
                                <div>
                                    <div class="mb-6">
                                        <a href="#"
                                            onclick="Livewire.emit('openModal', 'rack.add-subrack', {{ json_encode(['rack' => $rack->id]) }})"
                                            class="flex w-full items-center justify-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 shadow-sm hover:bg-gray-50">
                                            Tambah subrak
                                        </a>
                                    </div>
                                    <ul role="list" class="-my-5 divide-y divide-gray-200">
                                        @forelse ($rack->subracks as $subrack)
                                        <li class="py-4">
                                            <div class="flex items-center space-x-4">
                                                <div class="min-w-0 flex-1">
                                                    <p class="truncate text-sm font-medium text-gray-900">
                                                        {{ $subrack->name }}
                                                    </p>
                                                    <p class="truncate text-sm text-gray-500">
                                                        {{ $subrack->description }}
                                                    </p>
                                                </div>
                                                <div>
                                                    <a href="#"
                                                        onclick="Livewire.emit('openModal', 'rack.edit-subrack', {{ json_encode(['subrack' => $subrack->id]) }})"
                                                        class="inline-flex items-center rounded-full border border-gray-300 bg-white px-2.5 py-0.5 text-sm font-medium leading-5 text-gray-700 shadow-sm hover:bg-gray-50">Edit</a>
                                                    <a href="#" wire:click.prevent="deleteSubrack({{ $subrack->id }})"
                                                        class="inline-flex items-center rounded-full border border-red-300 bg-red px-2.5 py-0.5 text-sm font-medium leading-5 text-red-700 shadow-sm hover:bg-red-50">Hapus</a>
                                                </div>
                                            </div>
                                        </li>
                                        @empty
                                        <div class="truncate text-sm text-gray-500">Kosong</div>
                                        @endforelse
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </td>
                    <td class="relative py-3.5 pl-3 pr-4 sm:pr-6 text-right text-sm font-medium">
                        @include('livewire.rack._actions')
                    </td>
                </tr>
                @empty
                <tr>
                    <x-table.cell colspan="5">
                        <div class="flex justify-center items-center space-x-2">
                            <x-icon.inbox class="h-8 w-8 text-cool-gray-400" />
                            <span class="font-medium py-8 text-cool-gray-400 text-xl">Data tidak ditemukan</span>
                        </div>
                    </x-table.cell>
                </tr>
                @endforelse
            </x-slot>
        </x-table>
    </div>
</div>
