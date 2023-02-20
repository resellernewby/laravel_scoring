@props([
    'label' => false,
    'error' => false,
    'helpText' => false,
    'disabled' => false,
    'type' => 'text',
])

<div>
    @if ($label)
        <label class="block text-sm font-medium text-gray-700">
            {{ $label }}
        </label>
    @endif
    <div class="mt-1">
        <input {{ $attributes }} type="{{ $type }}"
            class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md {{ $disabled ? 'cursor-not-allowed' : '' }}"
            {{ $disabled ? 'disabled' : '' }}>
    </div>

    @if ($error)
        <div class="mt-1 text-red-500 text-sm">{{ $error }}</div>
    @endif

    @if ($helpText)
        <span class="mt-1 text-xs text-gray-500">{{ $helpText }}</span>
    @endif
</div>
