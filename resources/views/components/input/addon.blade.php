@props([
    'label' => false,
    'error' => false,
    'helpText' => false,
    'leadingAddOn' => false,
    'type' => 'text',
])

<div>
    @if ($label)
        <label class="block text-sm font-medium text-gray-700">
            {{ $label }}
        </label>
    @endif
    <div class="mt-1 flex rounded-md shadow-sm">
        <span
            class="inline-flex items-center rounded-l-md border border-r-0 border-gray-300 bg-gray-50 px-3 text-gray-500 sm:text-sm">{{ $leadingAddOn }}</span>
        <input type="{{ $type }}"
            {{ $attributes->merge(['class' => 'block w-full min-w-0 flex-1 rounded-none rounded-r-md border-gray-300 px-3 py-2 focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm']) }}>
    </div>
    @if ($error)
        <div class="mt-1 text-red-500 text-sm">{{ $error }}</div>
    @endif

    @if ($helpText)
        <p class="mt-1 text-sm text-gray-500">{{ $helpText }}</p>
    @endif
</div>
