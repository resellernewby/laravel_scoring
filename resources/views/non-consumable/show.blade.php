<x-app-layout>
    <div class="pt-8 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="flex-1 text-2xl font-bold text-gray-900">Detail Asset Non Consumable</h1>

        <div class="overflow-hidden bg-white shadow sm:rounded-lg my-10">
            <div class="px-4 py-5 sm:px-6">
                <h3 class="text-lg font-medium leading-6 text-gray-900">Informasi barang</h3>
                <p class="mt-1 max-w-2xl text-sm text-gray-500">Rincian informasi barang dan stok</p>
            </div>
            <div class="border-t border-gray-200">
                <dl>
                    <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">Nama barang</dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0">{{ $asset->name }}</dd>
                    </div>
                    <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">Merek</dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0">{{ $asset->brand->name }}</dd>
                    </div>
                    <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">Barcode</dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0">{{ $asset->barcode }}</dd>
                    </div>
                    <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">Harga saat ini</dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0">
                            Rp{{ number_format($asset->current_price) }}</dd>
                    </div>
                    <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">Terakhir kali beli</dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0">
                            {{ $asset->purchase_at->isoFormat('D MMMM Y') }}</dd>
                    </div>
                    <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">Sumber dana</dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0">{{ $asset->fundsSource->name }}
                        </dd>
                    </div>
                    <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">Suplier saat ini</dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0">{{ $asset->suplier->name }}</dd>
                    </div>
                    <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">Masa pakai</dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0">0
                            Bulan sejak pembelian
                        </dd>
                    </div>
                    <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">Stok tersedia</dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0">
                            <div>
                                <span class="text-lg font-bold">0</span>
                                <div class="flex space-x-8">
                                    @foreach ($asset->racks as $rack)
                                        <div>
                                            <span class="text-sm text-gray-500 font-semibold">{{ $rack->name }} (Qty:
                                                {{ $rack->pivot->qty }})</span>
                                            <p class="text-xs text-gray-500">
                                                {{ $rack->warehouse?->name }}
                                            </p>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </dd>
                    </div>
                    <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">Spesifikasi barang</dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0">
                            <ul role="list" class="divide-y divide-gray-200 rounded-md border border-gray-200">
                                @foreach ($asset->assetSpecifications as $spec)
                                    <li class="flex items-center py-3 pl-3 pr-4 text-sm">
                                        <div class="w-1/3">
                                            {{ $spec->name }}
                                        </div>
                                        <div class="w-2/3">
                                            : {{ $spec->value }}
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </dd>
                    </div>
                </dl>
            </div>
        </div>

        <!-- Payment details -->
        <div class="space-y-6 sm:px-6 lg:col-span-9 lg:px-0 mb-10">
            <!-- Billing history -->
            <section aria-labelledby="billing-history-heading">
                <div class="bg-white pt-6 shadow sm:overflow-hidden sm:rounded-md">
                    <div class="px-4 sm:px-6">
                        <h2 id="billing-history-heading" class="text-lg font-medium leading-6 text-gray-900">
                            Daftar asset {{ $asset->name }}
                        </h2>
                    </div>
                    <div class="mt-6 flex flex-col">
                        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                            <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
                                <div class="overflow-hidden border-t border-gray-200">
                                    <table class="min-w-full divide-y divide-gray-200">
                                        <thead class="bg-gray-50">
                                            <tr>
                                                <th scope="col"
                                                    class="px-6 py-3 text-left text-sm font-semibold text-gray-900">
                                                    Tanggal beli
                                                </th>
                                                <th scope="col"
                                                    class="px-6 py-3 text-left text-sm font-semibold text-gray-900">
                                                    Serial
                                                </th>
                                                <th scope="col"
                                                    class="px-6 py-3 text-left text-sm font-semibold text-gray-900">
                                                    Kondisi
                                                </th>
                                                <th scope="col"
                                                    class="px-6 py-3 text-left text-sm font-semibold text-gray-900">
                                                    Status
                                                </th>
                                                <th scope="col"
                                                    class="px-6 py-3 text-sm font-semibold text-gray-900 text-right">
                                                    Lokasi
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody class="divide-y divide-gray-200 bg-white">
                                            @foreach ($asset->nonConsumables as $non)
                                                <tr>
                                                    <td
                                                        class="whitespace-nowrap px-6 py-4 text-sm font-medium text-gray-900">
                                                        <time
                                                            datetime="2020-01-01">{{ $non->purchase_date->isoFormat('D MMMM Y') }}</time>
                                                    </td>
                                                    <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-500">
                                                        {{ $non->serial }}
                                                    </td>
                                                    <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-500">
                                                        {{ $non->condition }}
                                                    </td>
                                                    <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-500">
                                                        {{ $non->current_status }}
                                                    </td>
                                                    <td
                                                        class="whitespace-nowrap px-6 py-4 text-right text-sm font-medium">
                                                        <span class="text-orange-600 hover:text-orange-900">
                                                            {{ $non->nonConsumable?->name }}
                                                        </span>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</x-app-layout>
