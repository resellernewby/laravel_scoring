<nav aria-label="Sections" class="hidden w-96 flex-shrink-0 border-r border-blue-gray-200 bg-white xl:flex xl:flex-col">
    <div class="flex h-16 flex-shrink-0 items-center border-b border-blue-gray-200 px-6">
        <p class="text-lg font-medium text-blue-gray-900">Settings</p>
    </div>
    <div class="min-h-0 flex-1 overflow-y-auto">
        <a href="{{ route('setting.index') }}"
            class="{{ request()->routeIs('setting.index') ? 'bg-blue-50 bg-opacity-50' : 'hover:bg-blue-50 hover:bg-opacity-50' }} border-blue-gray-200 flex border-b p-6"
            aria-current="page">
            <svg class="-mt-0.5 h-6 w-6 flex-shrink-0 text-blue-gray-400" fill="none" viewBox="0 0 24 24"
                stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M4.5 12a7.5 7.5 0 0015 0m-15 0a7.5 7.5 0 1115 0m-15 0H3m16.5 0H21m-1.5 0H12m-8.457 3.077l1.41-.513m14.095-5.13l1.41-.513M5.106 17.785l1.15-.964m11.49-9.642l1.149-.964M7.501 19.795l.75-1.3m7.5-12.99l.75-1.3m-6.063 16.658l.26-1.477m2.605-14.772l.26-1.477m0 17.726l-.26-1.477M10.698 4.614l-.26-1.477M16.5 19.794l-.75-1.299M7.5 4.205L12 12m6.894 5.785l-1.149-.964M6.256 7.178l-1.15-.964m15.352 8.864l-1.41-.513M4.954 9.435l-1.41-.514M12.002 12l-3.75 6.495" />
            </svg>
            <div class="ml-3 text-sm">
                <p class="font-medium text-blue-gray-900">Umum</p>
                <p class="mt-1 text-blue-gray-500">Informasi umum nama instansi, logo, favicon dan lainnya.</p>
            </div>
        </a>

        <a href="{{ route('setting.notification') }}"
            class="{{ request()->routeIs('setting.notification') ? 'bg-blue-50 bg-opacity-50' : 'hover:bg-blue-50 hover:bg-opacity-50' }} border-blue-gray-200 flex border-b p-6">
            <svg class="-mt-0.5 h-6 w-6 flex-shrink-0 text-blue-gray-400" fill="none" viewBox="0 0 24 24"
                stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M14.857 17.082a23.848 23.848 0 005.454-1.31A8.967 8.967 0 0118 9.75v-.7V9A6 6 0 006 9v.75a8.967 8.967 0 01-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 01-5.714 0m5.714 0a3 3 0 11-5.714 0" />
            </svg>
            <div class="ml-3 text-sm">
                <p class="font-medium text-blue-gray-900">Notifikasi</p>
                <p class="mt-1 text-blue-gray-500">Informasi pengingat notifikasi, minimal barang segera
                    habis dan lainnya.</p>
            </div>
        </a>

        <a href="{{ route('setting.item-condition') }}"
            class="{{ request()->routeIs('setting.item-condition') ? 'bg-blue-50 bg-opacity-50' : 'hover:bg-blue-50 hover:bg-opacity-50' }} border-blue-gray-200 flex border-b p-6">
            <svg class="-mt-0.5 h-6 w-6 flex-shrink-0 text-blue-gray-400" fill="none" viewBox="0 0 24 24"
                stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M13.5 16.875h3.375m0 0h3.375m-3.375 0V13.5m0 3.375v3.375M6 10.5h2.25a2.25 2.25 0 002.25-2.25V6a2.25 2.25 0 00-2.25-2.25H6A2.25 2.25 0 003.75 6v2.25A2.25 2.25 0 006 10.5zm0 9.75h2.25A2.25 2.25 0 0010.5 18v-2.25a2.25 2.25 0 00-2.25-2.25H6a2.25 2.25 0 00-2.25 2.25V18A2.25 2.25 0 006 20.25zm9.75-9.75H18a2.25 2.25 0 002.25-2.25V6A2.25 2.25 0 0018 3.75h-2.25A2.25 2.25 0 0013.5 6v2.25a2.25 2.25 0 002.25 2.25z" />
            </svg>
            <div class="ml-3 text-sm">
                <p class="font-medium text-blue-gray-900">Kondisi Barang</p>
                <p class="mt-1 text-blue-gray-500">Pengaturan keterangan kondisi barang.</p>
            </div>
        </a>

        <a href="{{ route('setting.item-status') }}"
            class="{{ request()->routeIs('setting.item-status') ? 'bg-blue-50 bg-opacity-50' : 'hover:bg-blue-50 hover:bg-opacity-50' }} border-blue-gray-200 flex border-b p-6">
            <svg class="-mt-0.5 h-6 w-6 flex-shrink-0 text-blue-gray-400" fill="none" viewBox="0 0 24 24"
                stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M15.75 5.25a3 3 0 013 3m3 0a6 6 0 01-7.029 5.912c-.563-.097-1.159.026-1.563.43L10.5 17.25H8.25v2.25H6v2.25H2.25v-2.818c0-.597.237-1.17.659-1.591l6.499-6.499c.404-.404.527-1 .43-1.563A6 6 0 1121.75 8.25z" />
            </svg>
            <div class="ml-3 text-sm">
                <p class="font-medium text-blue-gray-900">Status Barang</p>
                <p class="mt-1 text-blue-gray-500">Pengaturan keterangan status barang.</p>
            </div>
        </a>

        {{-- <a href="{{ route('setting.damaged-item') }}"
            class="{{ request()->routeIs('setting.damaged-item') ? 'bg-blue-50 bg-opacity-50' : 'hover:bg-blue-50 hover:bg-opacity-50' }} border-blue-gray-200 flex border-b p-6">
            <svg class="-mt-0.5 h-6 w-6 flex-shrink-0 text-blue-gray-400" fill="none" viewBox="0 0 24 24"
                stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M13.5 16.875h3.375m0 0h3.375m-3.375 0V13.5m0 3.375v3.375M6 10.5h2.25a2.25 2.25 0 002.25-2.25V6a2.25 2.25 0 00-2.25-2.25H6A2.25 2.25 0 003.75 6v2.25A2.25 2.25 0 006 10.5zm0 9.75h2.25A2.25 2.25 0 0010.5 18v-2.25a2.25 2.25 0 00-2.25-2.25H6a2.25 2.25 0 00-2.25 2.25V18A2.25 2.25 0 006 20.25zm9.75-9.75H18a2.25 2.25 0 002.25-2.25V6A2.25 2.25 0 0018 3.75h-2.25A2.25 2.25 0 0013.5 6v2.25a2.25 2.25 0 002.25 2.25z" />
            </svg>
            <div class="ml-3 text-sm">
                <p class="font-medium text-blue-gray-900">Barang Rusak</p>
                <p class="mt-1 text-blue-gray-500">Keterangan barang rusak, gudang penyimpanan barang rusak dan terkait.
                </p>
            </div>
        </a> --}}
    </div>
</nav>
