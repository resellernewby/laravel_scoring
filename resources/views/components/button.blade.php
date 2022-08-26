@props([
'link' => ''
])

<span class="inline-flex rounded-md shadow-sm">
    @if (!empty($link))
    <a href="{{ $link }}" {{ $attributes->merge([
        'class' => 'py-2 px-4 border border-gray-200 rounded-md text-sm leading-5 font-medium focus:outline-none
        focus:ring-2 focus:ring-blue-500' . ($attributes->get('disabled') ? ' opacity-75
        cursor-not-allowed' : ''),
        ]) }}
        >
        {{ $slot }}
    </a>
    @else
    <button {{ $attributes->merge([
        'type' => 'button',
        'class' => 'py-2 px-4 border border-gray-200 rounded-md text-sm leading-5 font-medium focus:outline-none
        focus:ring-2 focus:ring-blue-500' . ($attributes->get('disabled') ? ' opacity-75
        cursor-not-allowed' : ''),
        ]) }}
        >
        {{ $slot }}
    </button>
    @endif
</span>