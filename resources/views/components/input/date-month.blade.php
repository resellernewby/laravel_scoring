@props([
'label' => false,
'error' => false,
'helpText' => false,
])

<div wire:ignore>
    @if ($label)
    <label class="block text-sm font-medium text-gray-700">
        {{ $label }}
    </label>
    @endif
    <div class="mt-1">
        <input x-data x-init="flatpickr($refs.input, {
                altInput: true,
                plugins: [
                    new monthSelectPlugin({
                    shorthand: true,
                    dateFormat: 'Y-m', 
                    altFormat: 'F Y'
                    })
                ]
            });" x-ref="input" {{ $attributes }} type="text"
            class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md">
    </div>

    @if ($error)
    <div class="mt-1 text-red-500 text-sm">{{ $error }}</div>
    @endif

    @if ($helpText)
    <p class="mt-2 text-sm text-gray-500">{{ $helpText }}</p>
    @endif
</div>