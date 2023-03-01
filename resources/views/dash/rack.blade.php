<x-app-layout>
    <div class="pt-8 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="flex-1 text-2xl font-bold text-gray-900">Rack</h1>
        <div class="sm:grid grid-cols-1">
            <!-- Table -->
            <livewire:rack.table :warehouse-id="$warehouseId" />
        </div>
    </div>
</x-app-layout>
