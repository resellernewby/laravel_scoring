<!DOCTYPE html>
<html class="h-full bg-gray-50" lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="h-full overflow-hidden">
    <div class="h-full flex">
        <!-- Narrow sidebar -->
        <div class="hidden w-28 bg-indigo-700 overflow-y-auto md:block">
            <div class="w-full py-6 flex flex-col items-center">
                <div class="flex-shrink-0 flex items-center">
                    <img class="h-8 w-auto" src="https://tailwindui.com/img/logos/workflow-mark.svg?color=white"
                        alt="Workflow">
                </div>
                <div class="flex-1 mt-6 w-full px-2 space-y-1">
                    <a href="#"
                        class="text-indigo-100 hover:bg-indigo-800 hover:text-white group w-full p-3 rounded-md flex flex-col items-center text-xs font-medium">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="text-indigo-300 group-hover:text-white h-6 w-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M4.098 19.902a3.75 3.75 0 005.304 0l6.401-6.402M6.75 21A3.75 3.75 0 013 17.25V4.125C3 3.504 3.504 3 4.125 3h5.25c.621 0 1.125.504 1.125 1.125v4.072M6.75 21a3.75 3.75 0 003.75-3.75V8.197M6.75 21h13.125c.621 0 1.125-.504 1.125-1.125v-5.25c0-.621-.504-1.125-1.125-1.125h-4.072M10.5 8.197l2.88-2.88c.438-.439 1.15-.439 1.59 0l3.712 3.713c.44.44.44 1.152 0 1.59l-2.879 2.88M6.75 17.25h.008v.008H6.75v-.008z" />
                        </svg>
                        <span class="mt-2">Barang</span>
                    </a>

                    <a href="#"
                        class="text-indigo-100 hover:bg-indigo-800 hover:text-white group w-full p-3 rounded-md flex flex-col items-center text-xs font-medium">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="text-indigo-300 group-hover:text-white h-6 w-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M20.25 14.15v4.25c0 1.094-.787 2.036-1.872 2.18-2.087.277-4.216.42-6.378.42s-4.291-.143-6.378-.42c-1.085-.144-1.872-1.086-1.872-2.18v-4.25m16.5 0a2.18 2.18 0 00.75-1.661V8.706c0-1.081-.768-2.015-1.837-2.175a48.114 48.114 0 00-3.413-.387m4.5 8.006c-.194.165-.42.295-.673.38A23.978 23.978 0 0112 15.75c-2.648 0-5.195-.429-7.577-1.22a2.016 2.016 0 01-.673-.38m0 0A2.18 2.18 0 013 12.489V8.706c0-1.081.768-2.015 1.837-2.175a48.111 48.111 0 013.413-.387m7.5 0V5.25A2.25 2.25 0 0013.5 3h-3a2.25 2.25 0 00-2.25 2.25v.894m7.5 0a48.667 48.667 0 00-7.5 0M12 12.75h.008v.008H12v-.008z" />
                        </svg>
                        <span class="mt-2">Asset</span>
                    </a>

                    <a href="#"
                        class="bg-indigo-800 text-white group w-full p-3 rounded-md flex flex-col items-center text-xs font-medium"
                        aria-current="page">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="text-indigo-300 group-hover:text-white h-6 w-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M8.25 21v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21m0 0h4.5V3.545M12.75 21h7.5V10.75M2.25 21h1.5m18 0h-18M2.25 9l4.5-1.636M18.75 3l-1.5.545m0 6.205l3 1m1.5.5l-1.5-.5M6.75 7.364V3h-3v18m3-13.636l10.5-3.819" />
                        </svg>
                        <span class="mt-2">Gudang</span>
                    </a>

                    <a href="#"
                        class="text-indigo-100 hover:bg-indigo-800 hover:text-white group w-full p-3 rounded-md flex flex-col items-center text-xs font-medium">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="text-indigo-300 group-hover:text-white h-6 w-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M18 18.72a9.094 9.094 0 003.741-.479 3 3 0 00-4.682-2.72m.94 3.198l.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0112 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 016 18.719m12 0a5.971 5.971 0 00-.941-3.197m0 0A5.995 5.995 0 0012 12.75a5.995 5.995 0 00-5.058 2.772m0 0a3 3 0 00-4.681 2.72 8.986 8.986 0 003.74.477m.94-3.197a5.971 5.971 0 00-.94 3.197M15 6.75a3 3 0 11-6 0 3 3 0 016 0zm6 3a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0zm-13.5 0a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0z" />
                        </svg>
                        <span class="mt-2">Users</span>
                    </a>

                    <a href="#"
                        class="text-indigo-100 hover:bg-indigo-800 hover:text-white group w-full p-3 rounded-md flex flex-col items-center text-xs font-medium">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="text-indigo-300 group-hover:text-white h-6 w-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M9.568 3H5.25A2.25 2.25 0 003 5.25v4.318c0 .597.237 1.17.659 1.591l9.581 9.581c.699.699 1.78.872 2.607.33a18.095 18.095 0 005.223-5.223c.542-.827.369-1.908-.33-2.607L11.16 3.66A2.25 2.25 0 009.568 3z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 6h.008v.008H6V6z" />
                        </svg>
                        <span class="mt-2">Tags</span>
                    </a>

                    <a href="#"
                        class="text-indigo-100 hover:bg-indigo-800 hover:text-white group w-full p-3 rounded-md flex flex-col items-center text-xs font-medium">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="text-indigo-300 group-hover:text-white h-6 w-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M10.343 3.94c.09-.542.56-.94 1.11-.94h1.093c.55 0 1.02.398 1.11.94l.149.894c.07.424.384.764.78.93.398.164.855.142 1.205-.108l.737-.527a1.125 1.125 0 011.45.12l.773.774c.39.389.44 1.002.12 1.45l-.527.737c-.25.35-.272.806-.107 1.204.165.397.505.71.93.78l.893.15c.543.09.94.56.94 1.109v1.094c0 .55-.397 1.02-.94 1.11l-.893.149c-.425.07-.765.383-.93.78-.165.398-.143.854.107 1.204l.527.738c.32.447.269 1.06-.12 1.45l-.774.773a1.125 1.125 0 01-1.449.12l-.738-.527c-.35-.25-.806-.272-1.203-.107-.397.165-.71.505-.781.929l-.149.894c-.09.542-.56.94-1.11.94h-1.094c-.55 0-1.019-.398-1.11-.94l-.148-.894c-.071-.424-.384-.764-.781-.93-.398-.164-.854-.142-1.204.108l-.738.527c-.447.32-1.06.269-1.45-.12l-.773-.774a1.125 1.125 0 01-.12-1.45l.527-.737c.25-.35.273-.806.108-1.204-.165-.397-.505-.71-.93-.78l-.894-.15c-.542-.09-.94-.56-.94-1.109v-1.094c0-.55.398-1.02.94-1.11l.894-.149c.424-.07.765-.383.93-.78.165-.398.143-.854-.107-1.204l-.527-.738a1.125 1.125 0 01.12-1.45l.773-.773a1.125 1.125 0 011.45-.12l.737.527c.35.25.807.272 1.204.107.397-.165.71-.505.78-.929l.15-.894z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                        <span class="mt-2">Settings</span>
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
                        <img class="h-8 w-auto" src="https://tailwindui.com/img/logos/workflow-mark.svg?color=white"
                            alt="Workflow">
                    </div>
                    <div class="mt-5 flex-1 h-0 px-2 overflow-y-auto">
                        <nav class="h-full flex flex-col">
                            <div class="space-y-1">
                                <a href="#"
                                    class="text-indigo-100 hover:bg-indigo-800 hover:text-white group py-2 px-3 rounded-md flex items-center text-sm font-medium">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor"
                                        class="text-indigo-300 group-hover:text-white mr-3 h-6 w-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M4.098 19.902a3.75 3.75 0 005.304 0l6.401-6.402M6.75 21A3.75 3.75 0 013 17.25V4.125C3 3.504 3.504 3 4.125 3h5.25c.621 0 1.125.504 1.125 1.125v4.072M6.75 21a3.75 3.75 0 003.75-3.75V8.197M6.75 21h13.125c.621 0 1.125-.504 1.125-1.125v-5.25c0-.621-.504-1.125-1.125-1.125h-4.072M10.5 8.197l2.88-2.88c.438-.439 1.15-.439 1.59 0l3.712 3.713c.44.44.44 1.152 0 1.59l-2.879 2.88M6.75 17.25h.008v.008H6.75v-.008z" />
                                    </svg>
                                    <span>Barang</span>
                                </a>

                                <a href="#"
                                    class="text-indigo-100 hover:bg-indigo-800 hover:text-white group py-2 px-3 rounded-md flex items-center text-sm font-medium">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor"
                                        class="text-indigo-300 group-hover:text-white mr-3 h-6 w-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M20.25 14.15v4.25c0 1.094-.787 2.036-1.872 2.18-2.087.277-4.216.42-6.378.42s-4.291-.143-6.378-.42c-1.085-.144-1.872-1.086-1.872-2.18v-4.25m16.5 0a2.18 2.18 0 00.75-1.661V8.706c0-1.081-.768-2.015-1.837-2.175a48.114 48.114 0 00-3.413-.387m4.5 8.006c-.194.165-.42.295-.673.38A23.978 23.978 0 0112 15.75c-2.648 0-5.195-.429-7.577-1.22a2.016 2.016 0 01-.673-.38m0 0A2.18 2.18 0 013 12.489V8.706c0-1.081.768-2.015 1.837-2.175a48.111 48.111 0 013.413-.387m7.5 0V5.25A2.25 2.25 0 0013.5 3h-3a2.25 2.25 0 00-2.25 2.25v.894m7.5 0a48.667 48.667 0 00-7.5 0M12 12.75h.008v.008H12v-.008z" />
                                    </svg>
                                    <span>Asset</span>
                                </a>

                                <a href="#"
                                    class="bg-indigo-800 text-white group py-2 px-3 rounded-md flex items-center text-sm font-medium"
                                    aria-current="page">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="text-white mr-3 h-6 w-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M8.25 21v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21m0 0h4.5V3.545M12.75 21h7.5V10.75M2.25 21h1.5m18 0h-18M2.25 9l4.5-1.636M18.75 3l-1.5.545m0 6.205l3 1m1.5.5l-1.5-.5M6.75 7.364V3h-3v18m3-13.636l10.5-3.819" />
                                    </svg>
                                    <span>Gudang</span>
                                </a>

                                <a href="#"
                                    class="text-indigo-100 hover:bg-indigo-800 hover:text-white group py-2 px-3 rounded-md flex items-center text-sm font-medium">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor"
                                        class="text-indigo-300 group-hover:text-white mr-3 h-6 w-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M18 18.72a9.094 9.094 0 003.741-.479 3 3 0 00-4.682-2.72m.94 3.198l.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0112 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 016 18.719m12 0a5.971 5.971 0 00-.941-3.197m0 0A5.995 5.995 0 0012 12.75a5.995 5.995 0 00-5.058 2.772m0 0a3 3 0 00-4.681 2.72 8.986 8.986 0 003.74.477m.94-3.197a5.971 5.971 0 00-.94 3.197M15 6.75a3 3 0 11-6 0 3 3 0 016 0zm6 3a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0zm-13.5 0a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0z" />
                                    </svg>
                                    <span>Users</span>
                                </a>

                                <a href="#"
                                    class="text-indigo-100 hover:bg-indigo-800 hover:text-white group py-2 px-3 rounded-md flex items-center text-sm font-medium">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor"
                                        class="text-indigo-300 group-hover:text-white mr-3 h-6 w-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M9.568 3H5.25A2.25 2.25 0 003 5.25v4.318c0 .597.237 1.17.659 1.591l9.581 9.581c.699.699 1.78.872 2.607.33a18.095 18.095 0 005.223-5.223c.542-.827.369-1.908-.33-2.607L11.16 3.66A2.25 2.25 0 009.568 3z" />
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M6 6h.008v.008H6V6z" />
                                    </svg>
                                    <span>Tags</span>
                                </a>

                                <a href="#"
                                    class="text-indigo-100 hover:bg-indigo-800 hover:text-white group py-2 px-3 rounded-md flex items-center text-sm font-medium">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor"
                                        class="text-indigo-300 group-hover:text-white mr-3 h-6 w-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M10.343 3.94c.09-.542.56-.94 1.11-.94h1.093c.55 0 1.02.398 1.11.94l.149.894c.07.424.384.764.78.93.398.164.855.142 1.205-.108l.737-.527a1.125 1.125 0 011.45.12l.773.774c.39.389.44 1.002.12 1.45l-.527.737c-.25.35-.272.806-.107 1.204.165.397.505.71.93.78l.893.15c.543.09.94.56.94 1.109v1.094c0 .55-.397 1.02-.94 1.11l-.893.149c-.425.07-.765.383-.93.78-.165.398-.143.854.107 1.204l.527.738c.32.447.269 1.06-.12 1.45l-.774.773a1.125 1.125 0 01-1.449.12l-.738-.527c-.35-.25-.806-.272-1.203-.107-.397.165-.71.505-.781.929l-.149.894c-.09.542-.56.94-1.11.94h-1.094c-.55 0-1.019-.398-1.11-.94l-.148-.894c-.071-.424-.384-.764-.781-.93-.398-.164-.854-.142-1.204.108l-.738.527c-.447.32-1.06.269-1.45-.12l-.773-.774a1.125 1.125 0 01-.12-1.45l.527-.737c.25-.35.273-.806.108-1.204-.165-.397-.505-.71-.93-.78l-.894-.15c-.542-.09-.94-.56-.94-1.109v-1.094c0-.55.398-1.02.94-1.11l.894-.149c.424-.07.765-.383.93-.78.165-.398.143-.854-.107-1.204l-.527-.738a1.125 1.125 0 01.12-1.45l.773-.773a1.125 1.125 0 011.45-.12l.737.527c.35.25.807.272 1.204.107.397-.165.71-.505.78-.929l.15-.894z" />
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                    <span>Settings</span>
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
                                <label for="desktop-search-field" class="sr-only">Search all files</label>
                                <label for="mobile-search-field" class="sr-only">Search all files</label>
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
                                        placeholder="Search all files" type="search">
                                </div>
                            </form>
                        </div>
                        <div class="ml-2 flex items-center space-x-4 sm:ml-6 sm:space-x-6">
                            <!-- Profile dropdown -->
                            <div x-data="{ open: false }" class="relative flex-shrink-0">
                                <div>
                                    <button x-on:click="open = !open" type="button"
                                        class="bg-white rounded-full flex text-sm focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                                        id="user-menu-button" aria-expanded="false" aria-haspopup="true">
                                        <span class="sr-only">Open user menu</span>
                                        <img class="h-8 w-8 rounded-full"
                                            src="https://images.unsplash.com/photo-1517365830460-955ce3ccd263?ixlib=rb-=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=8&w=256&h=256&q=80"
                                            alt="">
                                    </button>
                                </div>

                                <!-- Dropdown menu, show/hide based on menu state. -->
                                <div x-show="open" x-transition:enter="transition ease-out duration-100"
                                    x-transition:enter-start="transform opacity-0 scale-95"
                                    x-transition:enter-end="transform opacity-100 scale-100"
                                    x-transition:leave="transition ease-in duration-75"
                                    x-transition:leave-start="transform opacity-100 scale-100"
                                    x-transition:leave-end="transform opacity-0 scale-95"
                                    class="origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg py-1 bg-white ring-1 ring-black ring-opacity-5 focus:outline-none"
                                    role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button"
                                    tabindex="-1" x-cloak>
                                    <!-- Active: "bg-gray-100", Not Active: "" -->
                                    <a href="#" class="block px-4 py-2 text-sm text-gray-700" role="menuitem"
                                        tabindex="-1" id="user-menu-item-0">Your profile</a>

                                    <a href="#" class="block px-4 py-2 text-sm text-gray-700" role="menuitem"
                                        tabindex="-1" id="user-menu-item-1">Sign out</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Main content -->
            <div class="flex-1 flex items-stretch overflow-hidden">
                <main class="flex-1 overflow-y-auto">
                    <div class="pt-8 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                        <h1 class="flex-1 text-2xl font-bold text-gray-900">Barang Habis Pakai</h1>
                        <div>
                            <dl
                                class="mt-5 grid grid-cols-1 rounded-lg bg-white overflow-hidden shadow divide-y divide-gray-200 md:grid-cols-3 md:divide-y-0 md:divide-x">
                                <div class="px-4 py-5 sm:p-6">
                                    <dt class="text-base font-normal text-gray-900">Stok tersedia</dt>
                                    <dd class="mt-1 flex justify-between items-baseline md:block lg:flex">
                                        <div class="flex items-baseline text-2xl font-semibold text-indigo-600">
                                            71,897
                                            <span class="ml-1 font-medium text-gray-500">Jenis</span>
                                        </div>
                                    </dd>
                                </div>

                                <div class="px-4 py-5 sm:p-6">
                                    <dt class="text-base font-normal text-gray-900">Stok segera habis</dt>
                                    <dd class="mt-1 flex justify-between items-baseline md:block lg:flex">
                                        <div class="flex items-baseline text-2xl font-semibold text-indigo-600">
                                            14
                                            <span class="ml-1 font-medium text-gray-500">Jenis</span>
                                        </div>
                                    </dd>
                                </div>

                                <div class="px-4 py-5 sm:p-6">
                                    <dt class="text-base font-normal text-gray-900">Stok habis</dt>
                                    <dd class="mt-1 flex justify-between items-baseline md:block lg:flex">
                                        <div class="flex items-baseline text-2xl font-semibold text-indigo-600">
                                            21
                                            <span class="ml-1 font-medium text-gray-500">Jenis</span>
                                        </div>
                                    </dd>
                                </div>
                            </dl>
                        </div>

                        <!-- Table -->
                        <div class="-mx-4 mt-10 shadow bg-white sm:-mx-6 md:mx-0 md:rounded-lg">
                            <div
                                class="sm:flex sm:space-x-4 sm:items-center sm:justify-between sm:px-6 sm:py-4 px-3 py-3.5">
                                <!-- Search -->
                                <div class="w-full sm:w-64">
                                    <label for="search" class="sr-only">Search</label>
                                    <div class="relative text-gray-500 focus-within:text-gray-600">
                                        <div
                                            class="pointer-events-none absolute inset-y-0 left-0 pl-3 flex items-center">
                                            <!-- Heroicon name: solid/search -->
                                            <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg"
                                                viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                <path fill-rule="evenodd"
                                                    d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                        </div>
                                        <input wire:model="search"
                                            class="block w-full bg-white py-2 pl-10 pr-3 border border-gray-200 rounded-md focus:text-gray-500 focus:border-transparent focus:ring-0 placeholder-gray-500 focus:placeholder-gray-200 sm:text-sm"
                                            placeholder="Cari disini..." type="search">
                                    </div>
                                </div>
                                <div class="flex items-center space-x-2">
                                    {{-- <x-dropdown label="Filter" divider>
                                        <x-select label="Kelas" wire:model.debounce.500ms="filters.kelas"
                                            :list="$grades" />
                                        <x-select label="Jenjang" wire:model.debounce.500ms="filters.jenjang"
                                            :list="$levels" />
                                        <x-select label="Status" wire:model.debounce.500ms="filters.status"
                                            :list="$status" />
                                    </x-dropdown> --}}
                                    <x-button onclick="Livewire.emit('openModal', 'dash.billing.export')"
                                        class="flex items-center bg-white">
                                        <x-icon.o-download class="h-4 w-4 mr-1" /> Ekspor
                                    </x-button>
                                </div>
                            </div>

                            <table class="min-w-full divide-y divide-gray-300">
                                <thead>
                                    <tr>
                                        <th scope="col"
                                            class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6">
                                            Nama Barang
                                        </th>
                                        <th scope="col"
                                            class="hidden px-3 py-3.5 text-left text-sm font-semibold text-gray-900 lg:table-cell">
                                            Memory
                                        </th>
                                        <th scope="col"
                                            class="hidden px-3 py-3.5 text-left text-sm font-semibold text-gray-900 lg:table-cell">
                                            CPU</th>
                                        <th scope="col"
                                            class="hidden px-3 py-3.5 text-left text-sm font-semibold text-gray-900 lg:table-cell">
                                            Storage
                                        </th>
                                        <th scope="col"
                                            class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Price
                                        </th>
                                        <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-6">
                                            <span class="sr-only">Select</span>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="relative py-4 pl-4 sm:pl-6 pr-3 text-sm">
                                            <div class="font-medium text-gray-900">Hobby</div>
                                            <div class="mt-1 flex flex-col text-gray-500 sm:block lg:hidden">
                                                <span>4 GB RAM / 4 CPUs</span>
                                                <span class="hidden sm:inline"> · </span>
                                                <span>128 GB SSD disk</span>
                                            </div>
                                        </td>
                                        <td class="hidden px-3 py-3.5 text-sm text-gray-500 lg:table-cell">4 GB RAM
                                        </td>
                                        <td class="hidden px-3 py-3.5 text-sm text-gray-500 lg:table-cell">4 CPUs
                                        </td>
                                        <td class="hidden px-3 py-3.5 text-sm text-gray-500 lg:table-cell">128 GB
                                            SSD
                                            disk</td>
                                        <td class="px-3 py-3.5 text-sm text-gray-500">
                                            <span
                                                class="inline-flex rounded-full bg-green-100 px-2 text-xs font-semibold leading-5 text-green-800">Active</span>
                                        </td>
                                        <td class="relative py-3.5 pl-3 pr-4 sm:pr-6 text-right text-sm font-medium">
                                            <button type="button"
                                                class="inline-flex items-center rounded-md border border-gray-300 bg-white px-3 py-2 text-sm font-medium leading-4 text-gray-700 shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-30">Select<span
                                                    class="sr-only">, Hobby</span></button>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td
                                            class="relative py-4 pl-4 sm:pl-6 pr-3 text-sm border-t border-transparent">
                                            <div class="font-medium text-gray-900">
                                                Startup

                                                <span class="text-indigo-600">(Current Plan)</span>
                                            </div>
                                            <div class="mt-1 flex flex-col text-gray-500 sm:block lg:hidden">
                                                <span>8 GB RAM / 6 CPUs</span>
                                                <span class="hidden sm:inline"> · </span>
                                                <span>256 GB SSD disk</span>
                                            </div>

                                            <div class="absolute right-0 left-6 -top-px h-px bg-gray-200"></div>
                                        </td>
                                        <td
                                            class="hidden px-3 py-3.5 text-sm text-gray-500 lg:table-cell border-t border-gray-200">
                                            8 GB RAM
                                        </td>
                                        <td
                                            class="hidden px-3 py-3.5 text-sm text-gray-500 lg:table-cell border-t border-gray-200">
                                            6 CPUs
                                        </td>
                                        <td
                                            class="hidden px-3 py-3.5 text-sm text-gray-500 lg:table-cell border-t border-gray-200">
                                            256 GB
                                            SSD disk</td>
                                        <td class="px-3 py-3.5 text-sm text-gray-500 border-t border-gray-200">
                                            <span
                                                class="inline-flex rounded-full bg-green-100 px-2 text-xs font-semibold leading-5 text-green-800">Active</span>
                                        </td>
                                        <td
                                            class="relative py-3.5 pl-3 pr-4 sm:pr-6 text-right text-sm font-medium border-t border-transparent">
                                            <button type="button"
                                                class="inline-flex items-center rounded-md border border-gray-300 bg-white px-3 py-2 text-sm font-medium leading-4 text-gray-700 shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-30"
                                                disabled>Select<span class="sr-only">, Startup</span></button>

                                            <div class="absolute right-6 left-0 -top-px h-px bg-gray-200"></div>
                                        </td>
                                    </tr>

                                    <!-- More plans... -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                </main>
            </div>
        </div>
    </div>
</body>

</html>
