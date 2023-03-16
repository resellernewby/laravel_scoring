<div>
    <div x-data="{ open: false }" @keydown.window.escape="open = false" x-ref="dialog" class="relative z-10"
        aria-labelledby="slide-over-title" role="dialog" aria-modal="true">
        <button x-on:click="open = true" class="relative inline-block">
            <x-icon.o-shopping-cart class="w-6 h-6 text-gray-700" />
            @if ($carts->sum('qty') > 0)
                <span
                    class="absolute top-0 right-0 inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-red-100 transform translate-x-1/2 -translate-y-1/2 bg-red-600 rounded-full">{{ $carts->sum('qty') }}</span>
            @else
                <span
                    class="absolute top-0 right-0 inline-block w-2 h-2 transform translate-x-1/2 -translate-y-1/2 bg-red-600 rounded-full"></span>
            @endif
        </button>
        <div x-show="open" x-transition:enter="ease-in-out duration-500" x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100" x-transition:leave="ease-in-out duration-500"
            x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
            x-description="Background backdrop, show/hide based on slide-over state."
            class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" x-cloak>
        </div>

        <div class="fixed overflow-hidden" x-cloak>
            <div class="absolute inset-0 overflow-hidden">
                <div class="pointer-events-none fixed inset-y-0 right-0 flex max-w-full pl-10">
                    {{-- @click.away="open = false" bisa ditambahkan disini --}}
                    <div x-show="open" @click.away="open = false"
                        x-transition:enter="transform transition ease-in-out duration-500 sm:duration-700"
                        x-transition:enter-start="translate-x-full" x-transition:enter-end="translate-x-0"
                        x-transition:leave="transform transition ease-in-out duration-500 sm:duration-700"
                        x-transition:leave-start="translate-x-0" x-transition:leave-end="translate-x-full"
                        class="pointer-events-auto w-screen max-w-md"
                        x-description="Slide-over panel, show/hide based on slide-over state.">
                        <div class="flex h-full flex-col overflow-y-scroll bg-white shadow-xl">
                            <div class="flex-1 overflow-y-auto py-6 px-4 sm:px-6">
                                <div class="flex items-start justify-between">
                                    <h2 class="text-lg font-medium text-gray-900" id="slide-over-title">Keranjang
                                    </h2>
                                    <div class="ml-3 flex h-7 items-center">
                                        <button x-on:click="open = false" type="button" wire:loading.attr="disabled"
                                            wire:target="checkout" class="-m-2 p-2 text-gray-400 hover:text-gray-500">
                                            <span class="sr-only">Close panel</span>
                                            <!-- Heroicon name: outline/x-mark -->
                                            <x-icon.o-x class="h-6 w-6" />
                                        </button>
                                    </div>
                                </div>

                                <div class="mt-8">
                                    <div class="flow-root">
                                        @if (count($carts) > 0)
                                            <ul role="list" class="-my-6 divide-y divide-gray-200">
                                                @foreach ($carts as $key => $cart)
                                                    <li class="flex flex-col py-6">
                                                        <div class="flex">
                                                            <div
                                                                class="h-24 w-24 flex-shrink-0 overflow-hidden rounded-md border border-gray-200">
                                                                <img src="{{ $cart->asset->imageFirst?->image_thumb_url }}"
                                                                    alt="Salmon orange fabric pouch with match zipper, gray zipper pull, and adjustable hip belt."
                                                                    class="h-full w-full object-cover object-center">
                                                            </div>

                                                            <div class="ml-4 flex flex-1 flex-col">
                                                                <div>
                                                                    <div
                                                                        class="flex justify-between text-base font-medium text-gray-900">
                                                                        <h3>
                                                                            <a
                                                                                href="#">{{ $cart->asset->name }}</a>
                                                                        </h3>
                                                                    </div>
                                                                    <p class="mt-1 text-sm text-gray-500">
                                                                        {{ $cart->asset->brand->name }}
                                                                    </p>
                                                                </div>
                                                                <div
                                                                    class="flex flex-1 items-center justify-between text-sm">
                                                                    <div class="flex items-center">
                                                                        <button
                                                                            wire:click="decrement({{ $cart->id }})"
                                                                            class="relative inline-block"
                                                                            {{ $cart->qty <= 1 ? 'disabled' : '' }}>
                                                                            <x-icon.o-minus-circle
                                                                                class="w-6 h-6 text-indigo-700" />
                                                                        </button>
                                                                        <div class="w-11">
                                                                            <div class="relative">
                                                                                <input type="number" min="1"
                                                                                    wire:model.lazy="qts.{{ $key }}.qty"
                                                                                    class="block w-full border-0 p-0.5 text-gray-900 focus:ring-0 sm:text-sm sm:leading-6"
                                                                                    placeholder="0" />
                                                                                <div class="absolute inset-x-0 bottom-0 border-t border-gray-300 peer-focus:border-t-2 peer-focus:border-indigo-600"
                                                                                    aria-hidden="true"></div>
                                                                            </div>
                                                                        </div>
                                                                        <button
                                                                            wire:click="increment({{ $cart->id }})"
                                                                            class="relative inline-block">
                                                                            <x-icon.o-plus-circle
                                                                                class="w-6 h-6 text-indigo-700" />
                                                                        </button>
                                                                    </div>

                                                                    <div class="flex">
                                                                        <button wire:click="remove({{ $cart->id }})"
                                                                            class="inline-flex items-center group text-gray-500">
                                                                            <x-icon.o-trash
                                                                                class="w-6 h-6 group-hover:text-indigo-700" />
                                                                            <span
                                                                                class="group-hover:text-indigo-700">Hapus</span>
                                                                        </button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="mt-4">
                                                            <fieldset class="grid grid-cols-2 gap-2">
                                                                @foreach ($cart->asset->racks as $rack)
                                                                    <div class="relative flex items-start">
                                                                        <div class="flex h-5 items-center">
                                                                            <input
                                                                                wire:model.lazy="item.{{ $key }}.{{ $rack->id }}"
                                                                                type="checkbox"
                                                                                value="{{ $rack->pivot->qty }}"
                                                                                class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                                                                        </div>
                                                                        <div class="ml-3 text-sm">
                                                                            <label class="font-medium text-gray-700">
                                                                                {{ $rack->name }}
                                                                                <span class="text-gray-500">(Qty:
                                                                                    {{ $rack->pivot->qty }})</span>
                                                                            </label>
                                                                            <p class="text-gray-500 text-sm">
                                                                                {{ $rack->warehouse->name }}
                                                                            </p>
                                                                        </div>
                                                                    </div>
                                                                @endforeach
                                                            </fieldset>
                                                        </div>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        @else
                                            <h2 class="text-gray-700 text-xl font-bold">
                                                Wah, keranjang kamu kosong
                                            </h2>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="border-t border-gray-200 py-6 px-4 sm:px-6">
                                <div class="grid grid-cols-1">
                                    <x-input wire:model.lazy="taken_by" placeholder="Nama pengambil"
                                        :error="$errors->first('taken_by')" />
                                </div>
                                <div class="flex space-x-4 mt-4">
                                    <div class="w-full">
                                        <x-select wire:model.lazy="location_id" placeholder="Lokasi distribusi"
                                            :list="$locationLists" :error="$errors->first('location_id')" />
                                    </div>
                                    <div class="flex flex-col mt-1">
                                        <x-button.secondary onclick="Livewire.emit('openModal', 'location.create')"
                                            class="flex items-center" title="Tambah lokasi baru">
                                            <x-icon.plus class="h-5 w-5" />
                                        </x-button.secondary>
                                    </div>
                                </div>
                                <div class="mt-6">
                                    <a wire:click.prevent="checkout" wire:loading.class.remove="hover:bg-indigo-700"
                                        wire:loading.attr="disabled" href="#"
                                        class="flex items-center justify-center rounded-md border border-transparent bg-indigo-600 px-6 py-3 text-base font-medium text-white shadow-sm hover:bg-indigo-700">
                                        <span wire:loading.remove wire:target="checkout">Checkout</span>
                                        <span wire:loading.flex wire:target="checkout">
                                            <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white"
                                                xmlns="http://www.w3.org/2000/svg" fill="none"
                                                viewBox="0 0 24 24">
                                                <circle class="opacity-25" cx="12" cy="12"
                                                    r="10" stroke="currentColor" stroke-width="4"></circle>
                                                <path class="opacity-75" fill="currentColor"
                                                    d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                                                </path>
                                            </svg>
                                            Processing...
                                        </span>
                                    </a>
                                </div>
                                <div class="mt-6 flex justify-center text-center text-sm text-gray-500">
                                    <p>
                                        atau
                                        <button x-on:click="open = false" type="button" wire:loading.attr="disabled"
                                            wire:target="checkout"
                                            class="font-medium text-indigo-600 hover:text-indigo-500">
                                            Tambah barang lain
                                            <span aria-hidden="true"> &rarr;</span>
                                        </button>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
