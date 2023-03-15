<x-app-layout>
    <div class="pt-8 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="flex-1 text-2xl font-bold text-gray-900">Detail Asset Habis Pakai</h1>

        <div class="my-10 bg-white flex flex-col md:flex-row py-10 shadow sm:rounded-md">
            <div class="md:flex-1 px-4">
                <div x-data="{ image: 1 }">
                    <div class="aspect-h-64 md:aspect-h-80 rounded-lg bg-gray-100 mb-4">
                        @php
                            $no = 1;
                        @endphp
                        @foreach ($asset->assetImages as $image)
                            <div x-show="image === {{ $no }}"
                                class="aspect-h-64 md:aspect-h-80 rounded-lg bg-gray-100 mb-4 flex items-center justify-center"
                                {{ $no == 1 ? 'style="display: none;"' : '' }}>
                                <img src="{{ $image->image_url }}" class="object-cover w-full h-auto"
                                    alt="{{ $image->name }}">
                            </div>

                            @php
                                $no++;
                            @endphp
                        @endforeach
                    </div>

                    <div class="flex -mx-2 mb-4">
                        @php
                            $no = 1;
                        @endphp
                        @foreach ($asset->assetImages as $image)
                            <div class="flex-1 px-2">
                                <img x-on:click="image = {{ $no }}"
                                    class="focus:outline-none rounded-lg w-24 h-24 md:w-32 md:h-32"
                                    src="{{ $image->image_thumb_url }}" alt="">
                            </div>
                            @php
                                $no++;
                            @endphp
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="md:flex-1 px-4">
                <h2 class="mb-2 leading-tight tracking-tight font-bold text-gray-800 text-2xl md:text-3xl">
                    {{ $asset->name }}</h2>
                <p class="text-gray-500 text-sm">Merek <a href="#"
                        class="text-indigo-600 hover:underline">{{ $asset->brand->name }}</a></p>

                <div class="flex flex-col space-y-4">
                    <div class="flex flex-col items-start mt-4">
                        <span class="text-gray-500 text-sm">Stok barang</span>
                        <div class="flex items-center space-x-4">
                            <div class="rounded-lg bg-gray-100 py-1 px-3">
                                <span class="font-bold text-indigo-600 text-3xl">{{ $asset->qty }}</span>
                            </div>
                            @foreach ($asset->racks as $rack)
                                <div class="flex-1">
                                    <p class="text-green-500 text-xl font-semibold">
                                        {{ $rack->name }} (Qty:
                                        {{ $rack->pivot->qty }})
                                    </p>
                                    <p class="text-gray-400 text-sm">
                                        {{ $rack->warehouse?->name }}
                                    </p>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="flex items-center space-x-4">
                        <div class="flex-1">
                            <p class="text-orange-500 text-xl font-semibold">
                                Rp{{ number_format($asset->current_price) }}
                            </p>
                            <p class="text-gray-500 text-sm">
                                Terakhir beli {{ $asset->purchase_at->isoFormat('D MMMM Y') }}
                            </p>
                        </div>
                    </div>

                    <div class="flex flex-col items-start">
                        <span class="text-gray-500 text-sm">Sumber dana</span>
                        <div class="font-semibold text-gray-600 text-xl">{{ $asset->fundsSource->name }}
                            ({{ $asset->fundsSource->code }})</div>
                    </div>

                    <div class="flex flex-col items-start">
                        <span class="text-gray-500 text-sm">Suplier saat ini</span>
                        <div class="font-semibold text-gray-600 text-xl">{{ $asset->suplier->name }}</div>
                    </div>

                    <div class="flex flex-col items-start">
                        <span class="text-gray-500 text-sm">Masa pakai</span>
                        <div class="font-semibold text-gray-600 text-xl">{{ $asset->consumable->lifetime }}
                            <span class="text-gray-500 font-medium">Bulan sejak pembelian</span>
                        </div>
                    </div>

                    <div class="pt-6 text-sm text-gray-900 sm:col-span-2 sm:mt-0">
                        <span class="font-semibold text-gray-600 text-xl">Spesifikasi</span>
                        <ul role="list">
                            @foreach ($asset->assetSpecifications as $spec)
                                <li class="flex items-center py-3 text-sm">
                                    <div class="w-1/3">
                                        {{ $spec->name }}
                                    </div>
                                    <div class="w-2/3">
                                        : {{ $spec->value }}
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>

                {{-- <div class="flex py-4 space-x-4">
                    <button type="button"
                        class="h-14 px-6 py-2 font-semibold rounded-xl bg-indigo-600 hover:bg-indigo-500 text-white">
                        Add to Cart
                    </button>
                </div> --}}
            </div>
        </div>

        <!-- Payment details -->
        <div class="space-y-6 sm:px-6 lg:col-span-9 lg:px-0 mb-10">
            <!-- Billing history -->
            <section aria-labelledby="billing-history-heading">
                <div class="bg-white pt-6 shadow sm:overflow-hidden sm:rounded-md">
                    <div class="px-4 sm:px-6">
                        <h2 id="billing-history-heading" class="text-lg font-medium leading-6 text-gray-900">
                            Riwayat pemakaian
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
                                                    Tanggal
                                                </th>
                                                <th scope="col"
                                                    class="px-6 py-3 text-left text-sm font-semibold text-gray-900">
                                                    Pengambil
                                                </th>
                                                <th scope="col"
                                                    class="px-6 py-3 text-left text-sm font-semibold text-gray-900">
                                                    Qty
                                                </th>
                                                <th scope="col"
                                                    class="px-6 py-3 text-sm font-semibold text-gray-900 text-right">
                                                    Lokasi
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody class="divide-y divide-gray-200 bg-white">
                                            @foreach ($asset->consumable->consumableTransactions as $transaction)
                                                <tr>
                                                    <td
                                                        class="whitespace-nowrap px-6 py-4 text-sm font-medium text-gray-900">
                                                        <time
                                                            datetime="2020-01-01">{{ $transaction->date->isoFormat('D MMMM Y') }}</time>
                                                    </td>
                                                    <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-500">
                                                        {{ $transaction->user }}
                                                    </td>
                                                    <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-500">
                                                        {{ $transaction->qty }}
                                                    </td>
                                                    <td
                                                        class="whitespace-nowrap px-6 py-4 text-right text-sm font-medium">
                                                        <span class="text-orange-600 hover:text-orange-900">
                                                            {{ $transaction->location->name }}
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
