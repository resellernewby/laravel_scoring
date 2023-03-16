<div>
    <div>
        <dl
            class="mt-5 grid grid-cols-1 rounded-lg bg-white overflow-hidden shadow divide-y divide-gray-200 md:grid-cols-3 md:divide-y-0 md:divide-x">
            <div class="px-4 py-5 sm:p-6">
                <dt class="text-base font-normal text-gray-900">Barang rusak</dt>
                <dd class="mt-1 flex justify-between items-baseline md:block lg:flex">
                    <div wire:click="$emit('setStock', 'available')"
                        class="flex items-baseline text-2xl font-semibold text-indigo-600 hover:cursor-pointer hover:underline">
                        {{ $asset->damaged }}
                        <span class="ml-1 font-medium text-gray-500">Barang</span>
                    </div>
                </dd>
            </div>

            <div class="px-4 py-5 sm:p-6">
                <dt class="text-base font-normal text-gray-900">Dalam perbaikan</dt>
                <dd class="mt-1 flex justify-between items-baseline md:block lg:flex">
                    <div wire:click="$emit('setStock', 'lowstock')"
                        class="flex items-baseline text-2xl font-semibold text-indigo-600 hover:cursor-pointer hover:underline">
                        {{ $asset->repair }}
                        <span class="ml-1 font-medium text-gray-500">Barang</span>
                    </div>
                </dd>
            </div>

            <div class="px-4 py-5 sm:p-6">
                <dt class="text-base font-normal text-gray-900">Hasil penjualan</dt>
                <dd class="mt-1 flex justify-between items-baseline md:block lg:flex">
                    <div wire:click="$emit('setStock', 'outstock')"
                        class="flex items-baseline text-2xl font-semibold text-indigo-600 hover:cursor-pointer hover:underline">
                        Rp{{ number_format($sales) }}
                        <span class="ml-1 font-medium text-gray-500">/Tahun {{ date('Y') }}</span>
                    </div>
                </dd>
            </div>
        </dl>
    </div>
</div>
