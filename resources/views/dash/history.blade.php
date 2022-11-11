<x-app-layout>
    <div class="pt-8 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="flex-1 text-2xl font-bold text-gray-900">Riwayat keluar masuk barang dan asset</h1>

        <!-- Table -->
        @if ($goto == 'asset')
        <livewire:history.asset />
        @else
        <livewire:history.consumable />
        @endif
    </div>
</x-app-layout>
