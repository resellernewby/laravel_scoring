@props([
    'label' => false,
    'error' => false,
    'helpText' => false,
    'dateFormat' => 'Y-m-d',
    'altFormat' => 'j M Y',
    'options' => [],
])

@php
    $options = array_merge(
        [
            'dateFormat' => $dateFormat,
            'enableTime' => false,
            'altFormat' => $altFormat,
            'altInput' => true,
        ],
        $options,
    );
@endphp

<div wire:ignore>
    @if ($label)
        <label class="block text-sm font-medium text-gray-700">
            {{ $label }}
        </label>
    @endif
    <div class="mt-1">
        <input x-data="{
            value: @entangle($attributes->wire('model')),
            instance: undefined,
            init() {
                $watch('value', value => this.instance.setDate(value, false));
                this.instance = flatpickr(this.$refs.input, {{ json_encode((object) $options) }});
            }
        }" x-ref="input" x-bind:value="value" type="text"
            {{ $attributes->merge(['class' => 'shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md']) }} />
    </div>

    @if ($error)
        <div class="mt-1 text-red-500 text-sm">{{ $error }}</div>
    @endif

    @if ($helpText)
        <p class="mt-2 text-sm text-gray-500">{{ $helpText }}</p>
    @endif
</div>
