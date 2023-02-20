@props([
    'error' => false,
    'label',
    'helpText' => false,
    'disabled' => false,
])

<div class="relative flex items-start">
    <div class="flex h-5 items-center">
        <input {{ $attributes }} type="radio" class="h-4 w-4 border-gray-300 text-indigo-600 focus:ring-indigo-500"
            {{ $disabled ? 'disabled' : '' }}>
    </div>
    <div class="ml-3 text-sm">
        <label for="medium" class="font-medium text-gray-700">{{ $label }}</label>
        @if ($helpText)
            <p class="text-gray-500">{{ $helpText }}</p>
        @endif
        @if ($error)
            <p class="mt-1 text-red-500 text-sm">{{ $error }}</p>
        @endif
    </div>
</div>
