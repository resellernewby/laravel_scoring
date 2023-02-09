@props([
    'list' => [],
    'label' => false,
    'error' => false,
    'helpText' => false,
    'selected' => '',
])

<div wire:ignore x-data="{ values: @entangle($attributes->wire('model')), choices: null }" x-init="choices = new Choices($refs.single, {
    itemSelectText: '',
    removeItems: true,
    removeItemButton: true,
    allowHTML: true,
    maxItemCount: 1,
    renderChoiceLimit: 20,
    searchEnabled: true,
    searchChoices: true,
    searchFloor: 1,
    searchResultLimit: 5,
    searchFields: ['label', 'value'],
});

const refreshChoices = () => {
    for (const [value, label] of Object.entries(values)) {
        choices.setChoiceByValue(value || label)
    }
}

$refs.single.addEventListener('change', function(event) {
    values = []
    Array.from($refs.single.options).forEach(function(option) {
        values.push(option.value || option.text)
    })
})

$watch('values', () => refreshChoices())

refreshChoices()">
    @if ($label)
        <label for="location" class="block text-sm font-medium text-gray-700">{{ $label }}</label>
    @endif
    <select {{ $attributes }} x-ref="single">
        <option value="">Pilih item</option>
        @forelse ($list as $key => $value)
            <option value="{{ $key }}">{{ $value }}</option>
        @empty
        @endforelse
    </select>

    @if ($error)
        <div class="mt-1 text-red-500 text-sm">{{ $error }}</div>
    @endif

    @if ($helpText)
        <p class="mt-2 text-sm text-gray-500">{{ $helpText }}</p>
    @endif
</div>
