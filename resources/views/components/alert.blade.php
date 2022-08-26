@props([
'type' => 'success',
])

@php
$typeClasses = [
'info' => 'blue',
'warning' => 'yellow',
'error' => 'red',
'success' => 'green',
][$type];
@endphp

<div x-data="{ show: true }" x-show="show" class="rounded-md bg-{{ $typeClasses }}-50 p-4 mt-4">
    <div class="flex">
        <div class="flex-shrink-0">
            <x-icon.check-circle class="h-5 w-5 text-{{ $typeClasses }}-400" />
        </div>
        <div class="ml-3">
            <p class="text-sm font-medium text-{{ $typeClasses }}-800">
                {{ $slot }}
            </p>
        </div>
        <div class="ml-auto pl-3">
            <div class="-mx-1.5 -my-1.5">
                <button x-on:click="show = false" type="button"
                    class="inline-flex bg-{{ $typeClasses }}-50 rounded-md p-1.5 text-{{ $typeClasses }}-500 hover:bg-{{ $typeClasses }}-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-{{ $typeClasses }}-50 focus:ring-{{ $typeClasses }}-600">
                    <span class="sr-only">Dismiss</span>
                    <x-icon.x class="h-5 w-5" />
                </button>
            </div>
        </div>
    </div>
</div>