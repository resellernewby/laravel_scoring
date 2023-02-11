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
                    <div x-show="open"
                        x-transition:enter="transform transition ease-in-out duration-500 sm:duration-700"
                        x-transition:enter-start="translate-x-full" x-transition:enter-end="translate-x-0"
                        x-transition:leave="transform transition ease-in-out duration-500 sm:duration-700"
                        x-transition:leave-start="translate-x-0" x-transition:leave-end="translate-x-full"
                        class="pointer-events-auto w-screen max-w-md"
                        x-description="Slide-over panel, show/hide based on slide-over state."
                        @click.away="open = false">
                        <div class="flex h-full flex-col overflow-y-scroll bg-white shadow-xl">
                            <div class="flex-1 overflow-y-auto py-6 px-4 sm:px-6">
                                <div class="flex items-start justify-between">
                                    <h2 class="text-lg font-medium text-gray-900" id="slide-over-title">Keranjang
                                    </h2>
                                    <div class="ml-3 flex h-7 items-center">
                                        <button x-on:click="open = false" type="button"
                                            class="-m-2 p-2 text-gray-400 hover:text-gray-500">
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
                                                @foreach ($carts as $cart)
                                                    <li class="flex py-6">
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
                                                                        <a href="#">{{ $cart->asset->name }}</a>
                                                                    </h3>
                                                                </div>
                                                                <p class="mt-1 text-sm text-gray-500">
                                                                    {{ $cart->asset->brand->name }}
                                                                </p>
                                                            </div>
                                                            <div class="flex flex-1 items-end justify-between text-sm">
                                                                <div class="flex items-center space-x-2">
                                                                    <span class="text-gray-500">Qty</span>
                                                                    <div class="inline-flex items-center">
                                                                        <button
                                                                            wire:click="decrement({{ $cart->id }})"
                                                                            class="relative inline-block"
                                                                            {{ $cart->qty <= 1 ? 'disabled' : '' }}>
                                                                            <x-icon.o-minus-circle
                                                                                class="w-6 h-6 text-indigo-700" />
                                                                        </button>
                                                                        <span
                                                                            class="text-gray-500 border-b py-1 px-2">{{ $cart->qty }}</span>
                                                                        <button
                                                                            wire:click="increment({{ $cart->id }})"
                                                                            class="relative inline-block">
                                                                            <x-icon.o-plus-circle
                                                                                class="w-6 h-6 text-indigo-700" />
                                                                        </button>
                                                                    </div>
                                                                </div>

                                                                <div class="flex">
                                                                    <button wire:click="remove({{ $cart->id }})"
                                                                        type="button"
                                                                        class="font-medium text-indigo-600 hover:text-indigo-500">Hapus</button>
                                                                </div>
                                                            </div>
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
                                <div class="mt-6">
                                    <a wire:click.prevent="checkout" href="#"
                                        class="flex items-center justify-center rounded-md border border-transparent bg-indigo-600 px-6 py-3 text-base font-medium text-white shadow-sm hover:bg-indigo-700">Checkout</a>
                                </div>
                                <div class="mt-6 flex justify-center text-center text-sm text-gray-500">
                                    <p>
                                        atau
                                        <button x-on:click="open = false" type="button"
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
