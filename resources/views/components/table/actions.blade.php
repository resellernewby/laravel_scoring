<div>
    <div x-data="{ isOn: false }" class="relative inline-block text-left pl-2">
        <div>
            <button @click="isOn = !isOn" type="button" :class="{ 'bg-gray-100': isOn }"
                class="rounded-full flex items-center text-gray-600 hover:text-gray-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-100 focus:ring-indigo-500 bg-gray-100"
                id="menu-button" aria-expanded="true" aria-haspopup="true">
                <span class="sr-only">Open options</span>

                <x-icon.dots-vertical class="h-5 w-5 text-cool-gray-600" />
            </button>
        </div>
        <div x-show="isOn" @click.away="isOn = false" x-cloak
            class="z-10 origin-top-right absolute right-0 mt-2 w-56 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 focus:outline-none"
            role="menu" aria-orientation="vertical" aria-labelledby="menu-button" tabindex="-1" style="">
            <div class="py-1" role="none">
                {{ $slot }}
            </div>
        </div>
    </div>
</div>
