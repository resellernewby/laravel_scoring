@props([
    'label' => false,
    'error' => false,
    'helpText' => false,
    'leadingAddOn' => false,
])

<div>
    @if ($label)
        <label class="block text-sm font-medium text-gray-700">
            {{ $label }}
        </label>
    @endif
    <div class="mt-1 relative rounded-md shadow-sm">
        @if ($leadingAddOn)
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <span class="text-gray-500 sm:text-sm"> {{ $leadingAddOn }} </span>
            </div>
        @endif

        <input type="text" x-mask:dynamic="$money($input, ',')" {{ $attributes }}
            class="focus:ring-indigo-500 focus:border-indigo-500 block w-full pl-10 sm:pl-8 sm:text-sm border-gray-300 rounded-md" />
    </div>

    @if ($error)
        <div class="mt-1 text-red-500 text-sm">{{ $error }}</div>
    @endif

    @if ($helpText)
        <span class="mt-2 text-sm text-gray-500">{{ $helpText }}</span>
    @endif
</div>
