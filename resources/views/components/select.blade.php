@props([
    'list' => [],
    'label' => false,
    'error' => false,
    'helpText' => false,
    'selected' => '',
    'placeholder' => false,
])

<div>
    @if ($label)
        <label for="location" class="block text-sm font-medium text-gray-700">{{ $label }}</label>
    @endif
    <select {{ $attributes }}
        class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
        <option value="">{{ $placeholder ?? 'Pilih item' }}</option>
        @forelse ($list as $key => $value)
            <option value="{{ $key }}" @if ($selected == $key) selected @endif>{{ $value }}
            </option>
        @empty
        @endforelse
    </select>

    @if ($error)
        <div class="mt-1 text-red-500 text-sm">{{ $error }}</div>
    @endif

    @if ($helpText)
        <span class="mt-2 text-sm text-gray-500">{{ $helpText }}</span>
    @endif
</div>
