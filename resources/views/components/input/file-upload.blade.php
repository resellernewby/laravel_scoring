@props([
    'buttonName' => 'Change',
    'buttonRemove' => false,
    'label' => false,
])

<div>
    @if ($label)
        <label class="block text-sm font-medium text-blue-gray-900">{{ $label }}</label>
    @endif
    <div class="mt-1 flex items-center">
        {{ $slot }}

        <div x-data="{ focused: false }" class="ml-4 flex">
            <div
                class="relative flex cursor-pointer items-center rounded-md border border-blue-gray-300 bg-white py-2 px-3 shadow-sm focus-within:outline-none focus-within:ring-2 focus-within:ring-blue-500 focus-within:ring-offset-2 focus-within:ring-offset-blue-gray-50 hover:bg-blue-gray-50">
                <label for="user-photo" class="pointer-events-none relative text-sm font-medium text-blue-gray-900">
                    <span>{{ $buttonName }}</span>
                    <span class="sr-only"> user file</span>
                </label>
                <input @focus="focused = true" @blur="focused = false" type="file"
                    {{ $attributes->merge(['class' => 'absolute inset-0 h-full w-full cursor-pointer rounded-md border-gray-300 opacity-0']) }}>
            </div>
            @if ($buttonRemove)
                <button type="button"
                    class="ml-3 rounded-md border border-transparent bg-transparent py-2 px-3 text-sm font-medium text-blue-gray-900 hover:text-blue-gray-700 focus:border-blue-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 focus:ring-offset-blue-gray-50">Remove</button>
            @endif
        </div>
    </div>
</div>
