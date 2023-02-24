<x-app-layout>
    <div class="pt-8 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="flex-1 text-2xl font-bold text-gray-900">Edit Asset Non Consumable</h1>

        <!-- Tab -->
        <div x-data="{ tab: window.location.hash ? window.location.hash : '#edit-item' }" class="mt-5">
            <div class="sm:hidden">
                <label for="tabs" class="sr-only">Select a tab</label>
                <!-- Use an "onChange" listener to redirect the user to the selected tab URL. -->
                <select id="tabs" name="tabs"
                    class="block w-full rounded-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                    <option selected>Edit item</option>
                </select>
            </div>
            <div class="hidden sm:block">
                <div class="border-b border-gray-200">
                    <nav class="-mb-px flex space-x-8" aria-label="Tabs">
                        <!-- Current: "border-indigo-500 text-indigo-600", Default: "border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300" -->
                        <a href="#" x-on:click.prevent="tab='#edit-item'"
                            :class="{ 'border-indigo-500 text-indigo-600': (tab == '#edit-item') }"
                            class="border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 group inline-flex items-center py-4 px-1 border-b-2 font-medium text-sm"
                            aria-current="page">
                            <x-icon.squares-plus :class="{ 'text-indigo-500' : (tab == '#edit-item') }"
                                class="text-gray-400 group-hover:text-gray-500 -ml-0.5 mr-2 h-5 w-5" />
                            <span>Edit Item</span>
                        </a>
                    </nav>
                </div>
            </div>

            <div x-show="tab == '#edit-item'" x-cloak>
                <livewire:non-consumable.edit :asset="$asset->id" />
            </div>
        </div>
    </div>
</x-app-layout>
