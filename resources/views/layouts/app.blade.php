<!DOCTYPE html>
<html class="h-full bg-gray-50" lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @yield('meta')

    @hasSection('title')
        <title>@yield('title') - {{ config('app.name') }}</title>
    @else
        <title>{{ config('app.name') }}</title>
    @endif

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon-16x16.png') }}">
    <link rel="manifest" href="{{ asset('site.webmanifest') }}">
    <!-- Fonts -->
    {{-- <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet"> --}}
    {{-- <link href="https://cdn.jsdelivr.net/npm/tom-select@2.0.0/dist/css/tom-select.css" rel="stylesheet"> --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <livewire:styles />
    @stack('style')
</head>

<body class="h-full overflow-hidden">
    <div class="h-full flex">
        <!-- Narrow sidebar -->
        <div class="hidden w-28 bg-indigo-700 overflow-y-auto md:block">
            <div class="w-full py-6 flex flex-col items-center">
                <div class="flex-shrink-0 flex items-center">
                    <img class="h-8 w-auto" src="{{ asset('images/logo.png') }}" alt="Logo">
                </div>
                <div class="flex-1 mt-6 w-full px-2 space-y-1">
                    <a href="{{ route('warehouse') }}"
                        class="{{ request()->routeIs('warehouse') ? 'bg-indigo-800 text-white' : 'text-indigo-100 hover:bg-indigo-800 hover:text-white' }} group w-full p-3 rounded-md flex flex-col items-center text-xs font-medium"
                        aria-current="page">
                        <x-icon.o-square class="text-indigo-300 group-hover:text-white h-6 w-6" />
                        <span class="mt-2">Dash</span>
                    </a>

                    <a href="#" x-data="{ id: 1 }" x-on:click.prevent="$dispatch('opensecondary', {id})"
                        class="{{ request()->routeIs(['consumable.index', 'non-consumable.index', 'history']) ? 'bg-indigo-800 text-white' : 'text-indigo-100 hover:bg-indigo-800 hover:text-white' }} group w-full p-3 rounded-md flex flex-col items-center text-xs font-medium">
                        <x-icon.o-wallet class="text-indigo-300 group-hover:text-white h-6 w-6" />
                        <span class="mt-2">Asset</span>
                    </a>

                    <a href="{{ route('warehouse') }}"
                        class="{{ request()->routeIs('warehouse') ? 'bg-indigo-800 text-white' : 'text-indigo-100 hover:bg-indigo-800 hover:text-white' }} group w-full p-3 rounded-md flex flex-col items-center text-xs font-medium"
                        aria-current="page">
                        <x-icon.o-home-modern class="text-indigo-300 group-hover:text-white h-6 w-6" />
                        <span class="mt-2">Gudang</span>
                    </a>

                    <a href="{{ route('tag') }}"
                        class="{{ request()->routeIs('tag') ? 'bg-indigo-800 text-white' : 'text-indigo-100 hover:bg-indigo-800 hover:text-white' }} group w-full p-3 rounded-md flex flex-col items-center text-xs font-medium">
                        <x-icon.o-tag class="text-indigo-300 group-hover:text-white h-6 w-6" />
                        <span class="mt-2">Tags</span>
                    </a>

                    <a href="{{ route('brand') }}"
                        class="{{ request()->routeIs('brand') ? 'bg-indigo-800 text-white' : 'text-indigo-100 hover:bg-indigo-800 hover:text-white' }} group w-full p-3 rounded-md flex flex-col items-center text-xs font-medium">
                        <x-icon.o-check-badge class="text-indigo-300 group-hover:text-white h-6 w-6" />
                        <span class="mt-2">Merek</span>
                    </a>

                    <a href="{{ route('suplier') }}"
                        class="{{ request()->routeIs('suplier') ? 'bg-indigo-800 text-white' : 'text-indigo-100 hover:bg-indigo-800 hover:text-white' }} group w-full p-3 rounded-md flex flex-col items-center text-xs font-medium">
                        <x-icon.o-truck class="text-indigo-300 group-hover:text-white h-6 w-6" />
                        <span class="mt-2">Suplier</span>
                    </a>

                    <a href="{{ route('location') }}"
                        class="{{ request()->routeIs('location') ? 'bg-indigo-800 text-white' : 'text-indigo-100 hover:bg-indigo-800 hover:text-white' }} group w-full p-3 rounded-md flex flex-col items-center text-xs font-medium">
                        <x-icon.o-map-pin class="text-indigo-300 group-hover:text-white h-6 w-6" />
                        <span class="mt-2">Lokasi</span>
                    </a>

                    <a href="{{ route('funds-source') }}"
                        class="{{ request()->routeIs('funds-source') ? 'bg-indigo-800 text-white' : 'text-indigo-100 hover:bg-indigo-800 hover:text-white' }} group w-full p-3 rounded-md flex flex-col items-center text-xs font-medium">
                        <x-icon.o-banknotes class="text-indigo-300 group-hover:text-white h-6 w-6" />
                        <span class="mt-2">Dana</span>
                    </a>

                    <a href="{{ route('setting.index') }}"
                        class="{{ request()->routeIs(['setting.index', 'setting.notification', 'setting.item-condition', 'setting.item-status', 'setting.damaged-item']) ? 'bg-indigo-800 text-white' : 'text-indigo-100 hover:bg-indigo-800 hover:text-white' }} group w-full p-3 rounded-md flex flex-col items-center text-xs font-medium">
                        <x-icon.o-cog-8-tooth class="text-indigo-300 group-hover:text-white h-6 w-6" />
                        <span class="mt-2">Setting</span>
                    </a>
                </div>
            </div>
        </div>

        <!--
                Mobile menu
                Off-canvas menu for mobile, show/hide based on off-canvas menu state.
            -->
        <div x-data="{ open: false }" x-show="open" @opensidenav.window="if ($event.detail.id == 1) open = true"
            class="relative z-40 md:hidden" role="dialog" aria-modal="true" x-cloak>
            <!--
                Off-canvas menu backdrop, show/hide based on off-canvas menu state.
                -->
            <div x-transition:enter="transition-opacity ease-linear duration-300" x-transition:enter-start="opacity-0"
                x-transition:enter-end="opacity-100" x-transition:leave="transition-opacity ease-linear duration-300"
                x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
                class="fixed inset-0 bg-gray-600 bg-opacity-75"></div>

            <div class="fixed inset-0 z-40 flex">
                <!--
                    Off-canvas menu, show/hide based on off-canvas menu state.
                    -->
                <div x-transition:enter="transition ease-in-out duration-300 transform"
                    x-transition:enter-start="-translate-x-full" x-transition:enter-end="translate-x-0"
                    x-transition:leave="transition ease-in-out duration-300 transform"
                    x-transition:leave-start="translate-x-0" x-transition:leave-end="-translate-x-full"
                    class="relative max-w-xs w-full bg-indigo-700 pt-5 pb-4 flex-1 flex flex-col">
                    <!--
                        Close button, show/hide based on off-canvas menu state.
                        -->
                    <div x-transition:enter="ease-in-out duration-300" x-transition:enter-start="opacity-0"
                        x-transition:enter-end="opacity-100" x-transition:leave="ease-in-out duration-300"
                        x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
                        class="absolute top-1 right-0 -mr-14 p-1">
                        <button x-on:click="open = false" type="button"
                            class="h-12 w-12 rounded-full flex items-center justify-center focus:outline-none focus:ring-2 focus:ring-white">
                            <!-- Heroicon name: outline/x -->
                            <svg class="h-6 w-6 text-white" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                            <span class="sr-only">Close sidebar</span>
                        </button>
                    </div>

                    <div class="flex-shrink-0 px-4 flex items-center">
                        <img class="h-8 w-auto" src="{{ asset('images/logo.png') }}" alt="Workflow">
                    </div>
                    <div class="mt-5 flex-1 h-0 px-2 overflow-y-auto">
                        <nav class="h-full flex flex-col">
                            <div class="space-y-1">
                                <div x-data="{ open: false }" class="space-y-1">
                                    <button type="button" @click="open = !open"
                                        class="{{ request()->routeIs(['consumable.index', 'non-consumable.index', 'damaged-asset.index', 'history']) ? 'bg-indigo-800 text-white' : 'text-indigo-100 hover:bg-indigo-800 hover:text-white' }} group py-2 pl-3 pr-2 rounded-md flex w-full items-center justify-between text-sm font-medium">
                                        <div class="flex items-center">
                                            <x-icon.o-wallet
                                                class="text-indigo-300 group-hover:text-white mr-3 h-6 w-6" />
                                            <span>Asset</span>
                                        </div>
                                        <svg class="ml-3 h-5 w-5 flex-shrink-0 transform transition-colors duration-150 ease-in-out group-hover:text-gray-400 rotate-90 text-gray-400"
                                            viewBox="0 0 20 20" aria-hidden="true"
                                            :class="{ 'rotate-90 text-gray-400': open, 'text-gray-300': !(open) }">
                                            <path d="M6 6L14 10L6 14V6Z" fill="currentColor"></path>
                                        </svg>
                                    </button>

                                    <div x-description="Expandable link section, show/hide based on state."
                                        class="space-y-1" x-show="open">
                                        <a href="{{ route('consumable.index') }}"
                                            class="{{ request()->routeIs('consumable.index') ? 'bg-indigo-800 text-white' : 'text-indigo-100 hover:bg-indigo-800 hover:text-white' }} group py-2 pl-12 pr-2 rounded-md flex items-center text-sm font-medium">Consumable</a>

                                        <a href="{{ route('non-consumable.index') }}"
                                            class="{{ request()->routeIs('non-consumable.index') ? 'bg-indigo-800 text-white' : 'text-indigo-100 hover:bg-indigo-800 hover:text-white' }} group py-2 pl-12 pr-2 rounded-md flex items-center text-sm font-medium">Non
                                            Consumable</a>

                                        <a href="{{ route('damaged-asset.index') }}"
                                            class="{{ request()->routeIs('damaged-asset.index') ? 'bg-indigo-800 text-white' : 'text-indigo-100 hover:bg-indigo-800 hover:text-white' }} group py-2 pl-12 pr-2 rounded-md flex items-center text-sm font-medium">Barang
                                            Rusak</a>

                                        <a href="{{ route('history') }}"
                                            class="{{ request()->routeIs('history') ? 'bg-indigo-800 text-white' : 'text-indigo-100 hover:bg-indigo-800 hover:text-white' }} group py-2 pl-12 pr-2 rounded-md flex items-center text-sm font-medium">Riwayat
                                            Asset</a>
                                    </div>
                                </div>

                                <a href="{{ route('warehouse') }}"
                                    class="{{ request()->routeIs('warehouse') ? 'bg-indigo-800 text-white' : 'text-indigo-100 hover:bg-indigo-800 hover:text-white' }} group py-2 px-3 rounded-md flex items-center text-sm font-medium">
                                    <x-icon.o-home-modern
                                        class="text-indigo-300 group-hover:text-white mr-3 h-6 w-6" />
                                    <span>Gudang</span>
                                </a>

                                <a href="{{ route('tag') }}"
                                    class="{{ request()->routeIs('tag') ? 'bg-indigo-800 text-white' : 'text-indigo-100 hover:bg-indigo-800 hover:text-white' }} group py-2 px-3 rounded-md flex items-center text-sm font-medium">
                                    <x-icon.o-tag class="text-indigo-300 group-hover:text-white mr-3 h-6 w-6" />
                                    <span>Tags</span>
                                </a>

                                <a href="{{ route('brand') }}"
                                    class="{{ request()->routeIs('brand') ? 'bg-indigo-800 text-white' : 'text-indigo-100 hover:bg-indigo-800 hover:text-white' }} group py-2 px-3 rounded-md flex items-center text-sm font-medium">
                                    <x-icon.o-check-badge
                                        class="text-indigo-300 group-hover:text-white mr-3 h-6 w-6" />
                                    <span>Merek</span>
                                </a>

                                <a href="{{ route('suplier') }}"
                                    class="{{ request()->routeIs('suplier') ? 'bg-indigo-800 text-white' : 'text-indigo-100 hover:bg-indigo-800 hover:text-white' }} group py-2 px-3 rounded-md flex items-center text-sm font-medium">
                                    <x-icon.o-truck class="text-indigo-300 group-hover:text-white mr-3 h-6 w-6" />
                                    <span>Suplier</span>
                                </a>

                                <a href="{{ route('location') }}"
                                    class="{{ request()->routeIs('location') ? 'bg-indigo-800 text-white' : 'text-indigo-100 hover:bg-indigo-800 hover:text-white' }} group py-2 px-3 rounded-md flex items-center text-sm font-medium">
                                    <x-icon.o-map-pin class="text-indigo-300 group-hover:text-white mr-3 h-6 w-6" />
                                    <span>Lokasi</span>
                                </a>

                                <a href="{{ route('funds-source') }}"
                                    class="{{ request()->routeIs('funds-source') ? 'bg-indigo-800 text-white' : 'text-indigo-100 hover:bg-indigo-800 hover:text-white' }} group py-2 px-3 rounded-md flex items-center text-sm font-medium">
                                    <x-icon.o-banknotes class="text-indigo-300 group-hover:text-white mr-3 h-6 w-6" />
                                    <span>Dana</span>
                                </a>

                                <a href="{{ route('setting.index') }}"
                                    class="{{ request()->routeIs('setting.index') ? 'bg-indigo-800 text-white' : 'text-indigo-100 hover:bg-indigo-800 hover:text-white' }} group py-2 px-3 rounded-md flex items-center text-sm font-medium">
                                    <x-icon.o-cog-8-tooth
                                        class="text-indigo-300 group-hover:text-white mr-3 h-6 w-6" />
                                    <span>Setting</span>
                                </a>
                            </div>
                        </nav>
                    </div>
                </div>

                <div class="flex-shrink-0 w-14" aria-hidden="true">
                    <!-- Dummy element to force sidebar to shrink to fit close icon -->
                </div>
            </div>
        </div>

        <!-- Content area -->
        <div class="flex-1 flex flex-col overflow-hidden">
            <header class="w-full">
                <div class="relative z-10 flex-shrink-0 h-16 bg-white border-b border-gray-200 shadow-sm flex">
                    <button x-data x-on:click="$dispatch('opensidenav', {id: 1})" type="button"
                        class="border-r border-gray-200 px-4 text-gray-500 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-indigo-500 md:hidden">
                        <span class="sr-only">Open sidebar</span>
                        <!-- Heroicon name: outline/menu-alt-2 -->
                        <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke-width="2" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h7" />
                        </svg>
                    </button>
                    <div class="flex-1 flex justify-between px-4 sm:px-6">
                        <div class="flex-1 flex">
                            <form class="w-full flex md:ml-0" action="#" method="GET">
                                <label for="desktop-search-field" class="sr-only">Search</label>
                                <label for="mobile-search-field" class="sr-only">Search</label>
                                <div class="relative w-full text-gray-400 focus-within:text-gray-600">
                                    <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center">
                                        <!-- Heroicon name: solid/search -->
                                        <svg class="flex-shrink-0 h-5 w-5" xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                            <path fill-rule="evenodd"
                                                d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                    <input name="mobile-search-field" id="mobile-search-field"
                                        class="h-full w-full border-transparent py-2 pl-8 pr-3 text-base text-gray-900 placeholder-gray-500 focus:outline-none focus:ring-0 focus:border-transparent focus:placeholder-gray-400 sm:hidden"
                                        placeholder="Search" type="search">
                                    <input name="desktop-search-field" id="desktop-search-field"
                                        class="hidden h-full w-full border-transparent py-2 pl-8 pr-3 text-base text-gray-900 placeholder-gray-500 focus:outline-none focus:ring-0 focus:border-transparent focus:placeholder-gray-400 sm:block"
                                        placeholder="Search" type="search">
                                </div>
                            </form>
                        </div>
                        <div class="ml-2 flex items-center space-x-4 sm:ml-6 sm:space-x-6">
                            <div x-data="{ isOpen: false }" class="relative">
                                <button @click="isOpen = !isOpen"
                                    class="p-1 rounded-full text-gray-500 hover:text-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-indigo-600 focus:ring-white">
                                    <span class="sr-only">View notifications</span>
                                    <!-- Heroicon name: outline/bell -->
                                    <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9">
                                        </path>
                                    </svg>
                                </button>

                                <div x-show="isOpen" @click.away="isOpen = false"
                                    x-transition:enter="transition ease-out duration-100"
                                    x-transition:enter-start="transform opacity-0 scale-95"
                                    x-transition:enter-end="transform opacity-100 scale-100"
                                    x-transition:leave="transition ease-in duration-75"
                                    x-transition:leave-start="transform opacity-100 scale-100"
                                    x-transition:leave-end="transform opacity-0 scale-95"
                                    class="origin-top-right z-40 absolute right-0 mt-2 w-80 rounded-md shadow-lg py-1 bg-white ring-1 ring-black ring-opacity-5 focus:outline-none"
                                    role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button"
                                    tabindex="-1" style="display: none;">
                                    <div class="relative grid gap-6 bg-white px-5 py-6 sm:gap-8 sm:p-8">
                                        <a href="#"
                                            class="-m-3 p-3 block rounded-md hover:bg-gray-50 transition ease-in-out duration-150">
                                            <p class="text-base font-medium text-gray-900">
                                                Stok segera habis
                                            </p>
                                            <p class="mt-1 text-sm text-gray-500">
                                                Learn about tips, product updates and company culture.
                                            </p>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <!-- Profile dropdown -->
                            <div x-data="{ open: false }" class="relative flex-shrink-0">
                                <div>
                                    <button x-on:click="open = !open" type="button"
                                        class="bg-white rounded-full flex text-sm focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                                        id="user-menu-button" aria-expanded="false" aria-haspopup="true">
                                        <span class="sr-only">Open user menu</span>
                                        <img class="h-8 w-8 rounded-full" src="{{ asset('images/admin.png') }}"
                                            alt="Avatar">
                                    </button>
                                </div>

                                <!-- Dropdown menu, show/hide based on menu state. -->
                                <div x-show="open" x-on:click.away="open = false"
                                    x-transition:enter="transition ease-out duration-100"
                                    x-transition:enter-start="transform opacity-0 scale-95"
                                    x-transition:enter-end="transform opacity-100 scale-100"
                                    x-transition:leave="transition ease-in duration-75"
                                    x-transition:leave-start="transform opacity-100 scale-100"
                                    x-transition:leave-end="transform opacity-0 scale-95"
                                    class="origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg py-1 bg-white ring-1 ring-black ring-opacity-5 focus:outline-none"
                                    role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button"
                                    tabindex="-1" x-cloak>
                                    <!-- Active: "bg-gray-100", Not Active: "" -->

                                    <a href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                                document.getElementById('logout-form').submit();"
                                        class="block px-4 py-2 text-sm text-gray-700" role="menuitem"
                                        tabindex="-1">Log
                                        out</a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST">
                                        @csrf
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Main content -->
            <div class="flex-1 flex items-stretch overflow-hidden">
                <main class="flex-1 overflow-y-auto">
                    {{ $slot }}
                </main>

                <aside x-data="{ secondary: false }" x-show="secondary"
                    @opensecondary.window="if ($event.detail.id == 1) secondary = true"
                    @click.away="secondary = false" x-cloak class="hidden md:order-first md:block md:flex-shrink-0">
                    <div class="relative flex h-full w-64 flex-col overflow-y-auto border-r border-gray-200 bg-white">
                        <div class="flex h-16 flex-shrink-0 items-center px-6">
                            <p class="text-lg font-medium text-blue-gray-900">Asset</p>
                        </div>
                        <nav class="space-y-1">
                            <a href="{{ route('consumable.index') }}"
                                class="{{ request()->routeIs('consumable.index') ? 'bg-blue-50 border-blue-500 text-blue-700 hover:bg-blue-50 hover:text-blue-700' : 'border-transparent text-gray-900 hover:bg-gray-50 hover:text-gray-900' }} group border-l-4 px-6 py-2 flex items-center text-sm font-medium"
                                aria-current="page">
                                <x-icon.o-cube
                                    class="{{ request()->routeIs('consumable.index') ? 'text-blue-500 group-hover:text-blue-500' : 'text-gray-400 group-hover:text-gray-500' }} flex-shrink-0 -ml-1 mr-3 h-6 w-6" />
                                <span class="truncate">Consumable</span>
                            </a>

                            <a href="{{ route('non-consumable.index') }}"
                                class="{{ request()->routeIs('non-consumable.index') ? 'bg-blue-50 border-blue-500 text-blue-700 hover:bg-blue-50 hover:text-blue-700' : 'border-transparent text-gray-900 hover:bg-gray-50 hover:text-gray-900' }} group border-l-4 px-6 py-2 flex items-center text-sm font-medium">
                                <x-icon.o-computer-desktop
                                    class="{{ request()->routeIs('non-consumable.index') ? 'text-blue-500 group-hover:text-blue-500' : 'text-gray-400 group-hover:text-gray-500' }} flex-shrink-0 -ml-1 mr-3 h-6 w-6" />
                                <span class="truncate">Non Consumable</span>
                            </a>

                            <a href="{{ route('damaged-asset.index') }}"
                                class="{{ request()->routeIs('damaged-asset.index') ? 'bg-blue-50 border-blue-500 text-blue-700 hover:bg-blue-50 hover:text-blue-700' : 'border-transparent text-gray-900 hover:bg-gray-50 hover:text-gray-900' }} group border-l-4 px-6 py-2 flex items-center text-sm font-medium">
                                <x-icon.o-archive-box-x-mark
                                    class="{{ request()->routeIs('damaged-asset.index') ? 'text-blue-500 group-hover:text-blue-500' : 'text-gray-400 group-hover:text-gray-500' }} flex-shrink-0 -ml-1 mr-3 h-6 w-6" />
                                <span class="truncate">Barang rusak</span>
                            </a>

                            <a href="{{ route('history') }}"
                                class="{{ request()->routeIs('history') ? 'bg-blue-50 border-blue-500 text-blue-700 hover:bg-blue-50 hover:text-blue-700' : 'border-transparent text-gray-900 hover:bg-gray-50 hover:text-gray-900' }} group border-l-4 px-6 py-2 flex items-center text-sm font-medium">
                                <x-icon.o-trending-up
                                    class="{{ request()->routeIs('history') ? 'text-blue-500 group-hover:text-blue-500' : 'text-gray-400 group-hover:text-gray-500' }} flex-shrink-0 -ml-1 mr-3 h-6 w-6" />
                                <span class="truncate">Riwayat asset</span>
                            </a>
                        </nav>
                    </div>
                </aside>
            </div>
        </div>
    </div>

    @livewire('livewire-ui-modal')
    <livewire:scripts />
    <x-notification />
    {{-- <script src="https://cdn.jsdelivr.net/npm/tom-select@2.0.0/dist/js/tom-select.complete.min.js"></script> --}}
    @stack('script')
</body>

</html>
