<div>
    <div class="-mx-4 my-10 shadow bg-white sm:-mx-6 md:mx-0 md:rounded-lg">
        <div class="sm:flex sm:space-x-4 sm:items-center sm:justify-between sm:px-6 sm:py-4 px-3 py-3.5">
            <!-- Search -->
            <div class="w-full">
                Daftar Rak di <strong>{{ $warehouse->name }}</strong>
            </div>
            <div class="flex items-center space-x-2">
                <x-button.primary
                    onclick="Livewire.emit('openModal', 'rack.create', {{ json_encode(['warehouse' => $warehouse->id]) }})"
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
                <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6">
                    Jenis Barang
                </th>
                <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-6">
                    <span class="sr-only">Select</span>
                </th>
            </x-slot>
            <x-slot name="body">
                @forelse ($warehouse->racks as $rack)
                    <tr wire:key="rack-{{ $rack->id }}" wire:loading.class.delay="opacity-50"
                        class="hover:bg-gray-50">
                        <td class="relative py-4 pl-4 sm:pl-6 pr-3 text-sm">
                            <div class="flex items-center mb-1">
                                <p class="font-medium text-gray-900">
                                    {{ $rack->name }} <span class="text-gray-500">(Qty:
                                        {{ $rack->assets?->sum('pivot.qty') }})</span>
                                </p>
                            </div>
                            <div class="text-gray-500">
                                {{ $rack->description }}
                            </div>
                        </td>
                        <td class="relative py-4 pl-4 sm:pl-6 pr-3 text-sm">
                            @foreach ($rack->assets as $asset)
                                <p>{{ $asset->name }} <span class="text-gray-500">merek
                                        {{ $asset->brand->name }}</span></p>
                            @endforeach
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
