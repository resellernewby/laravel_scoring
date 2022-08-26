@props([
'message',
'title'
])

<div x-data="{ tooltip: false }">
    <div x-show="tooltip" class="relative mx-2">
        <div class="z-50 absolute bg-black text-white text-xs rounded py-1 px-4 right-0 bottom-full" x-cloak>
            {{ $message }}
            <svg class="absolute text-black h-2 left-0 ml-3 top-full" x="0px" y="0px" viewBox="0 0 255 255"
                xml:space="preserve">
                <polygon class="fill-current" points="0,0 127.5,127.5 255,0" />
            </svg>
        </div>
    </div>
    <div x-on:mouseenter="tooltip = true" x-on:mouseleave="tooltip = false" class="cursor-pointer">
        {{ $title }}
    </div>
</div>
