<div>
    <div class="-mx-4 my-10 shadow bg-white sm:-mx-6 md:mx-0 md:rounded-lg">
        <div class="sm:flex sm:space-x-4 sm:items-center sm:justify-between sm:px-6 sm:py-4 px-3 py-3.5">
            <!-- Search -->
            <div class="w-96">
                <label for="search" class="sr-only">Search</label>
                <div class="relative text-gray-500 focus-within:text-gray-600">
                    <div class="pointer-events-none absolute inset-y-0 left-0 pl-3 flex items-center">
                        <x-icon.search class="h-5 w-5" />
                    </div>
                    <input wire:model.debounce.500ms="search"
                        class="block w-full bg-white py-2 pl-10 pr-3 border border-gray-200 rounded-md focus:text-gray-500 focus:border-blue-500 focus:ring-blue-500 placeholder-gray-500 focus:placeholder-gray-200 sm:text-sm"
                        placeholder="Cari nama kelas..." type="search">
                </div>
            </div>
            <div class="flex items-center space-x-2">
                <x-button.primary onclick="Livewire.emit('openModal', 'score.create')"
                    class="flex items-center bg-white">
                    <x-icon.plus class="h-4 w-4 mr-1" /> Create
                </x-button.primary>
            </div>
        </div>

        <x-table>
            <x-slot name="head">
                <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6">
                    Nama Kelas
                </th>
                <th scope="col"
                    class="hidden px-3 py-3.5 text-left text-sm font-semibold text-gray-900 lg:table-cell">
                    Lantai
                </th>
                <th scope="col"
                    class="hidden px-3 py-3.5 text-left text-sm font-semibold text-gray-900 lg:table-cell">
                    Meja
                </th>
                <th scope="col"
                    class="hidden px-3 py-3.5 text-left text-sm font-semibold text-gray-900 lg:table-cell">
                    Peralatan
                </th>
                <th scope="col"
                    class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900 lg:table-cell">
                    Total
                </th>
                <th scope="col"
                    class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900 lg:table-cell">
                    Tanggal
                </th>
                <th scope="col"
                    class="hidden px-3 py-3.5 text-left text-sm font-semibold text-gray-900 lg:table-cell">
                    Penilai
                </th>              
                <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-6">
                    <span class="sr-only">Select</span>
                </th>
            </x-slot>
            <x-slot name="body">
                @forelse ($scores as $score)
                    <tr wire:key="score-{{ $score->id }}" wire:loading.class.delay="opacity-50">
                        <td
                            class="relative py-4 pl-4 sm:pl-6 pr-3 text-sm {{ !$loop->first ? 'border-t border-transparent' : '' }}">
                            <div>
                                <span class="font-medium text-gray-900">{{ $score->classroom->name }}</span>
                            </div>
                            
                            @if (!$loop->first)
                                <div class="absolute right-0 left-6 -top-px h-px bg-gray-200"></div>
                            @endif
                        </td>
                        <td
                            class="hidden px-3 py-3.5 text-sm text-gray-500 lg:table-cell {{ !$loop->first ? 'border-t border-gray-200' : '' }}">
                            {{ $score->scoring_floor }}
                        </td>
                        <td
                            class="hidden px-3 py-3.5 text-sm text-gray-500 lg:table-cell {{ !$loop->first ? 'border-t border-gray-200' : '' }}">
                            {{ $score->scoring_table }}
                        </td>
                        <td
                            class="hidden px-3 py-3.5 text-sm text-gray-500 lg:table-cell {{ !$loop->first ? 'border-t border-gray-200' : '' }}">
                            {{ $score->scoring_equipment }}
                        </td>
                        <td
                            class="px-3 py-3.5 text-sm text-gray-500 lg:table-cell {{ !$loop->first ? 'border-t border-gray-200' : '' }}">
                            {{ $score->scoring_total }}
                        </td>
                        <td
                            class="px-3 py-3.5 text-sm text-gray-500 lg:table-cell {{ !$loop->first ? 'border-t border-gray-200' : '' }}">
                            {{ $score->scoring_date->format('Y-m-d') }}
                        </td>
                        <td
                            class="hidden px-3 py-3.5 text-sm text-gray-500 lg:table-cell {{ !$loop->first ? 'border-t border-gray-200' : '' }}">
                            {{ $score->user->name }}
                        </td>
                        
                        <td
                            class="relative py-3.5 pl-3 pr-4 sm:pr-6 text-right text-sm font-medium {{ !$loop->first ? 'border-t border-transparent' : '' }}">
                            @include('livewire.score._actions')
                            @if (!$loop->first)
                                <div class="absolute right-6 left-0 -top-px h-px bg-gray-200"></div>
                            @endif
                            
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

        <div class="sm:px-6 sm:py-4 px-3 py-3.5">
            {{ $scores->links() }}
        </div>
    </div>
</div>

