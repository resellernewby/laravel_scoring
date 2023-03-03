@props([
    'color' => 'gray',
    'text',
    'remove' => false,
])

@php
    switch ($color) {
        case 'red':
            $colors = 'bg-red-100 text-red-800';
            break;
    
        case 'green':
            $colors = 'bg-green-100 text-green-800';
            break;
    
        case 'blue':
            $colors = 'bg-blue-100 text-blue-800';
            break;
    
        case 'yellow':
            $colors = 'bg-yellow-100 text-yellow-800';
            break;
    
        case 'indigo':
            $colors = 'bg-indigo-100 text-indigo-800';
            break;
    
        case 'purple':
            $colors = 'bg-purple-100 text-purple-800';
            break;
    
        default:
            $colors = 'bg-gray-100 text-gray-800';
            break;
    }
@endphp

<span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $colors }}"
    {{ $attributes }}>
    {{ $slot }}
    {{ $text }}
    @if ($remove)
        <button type="button"
            class="ml-0.5 inline-flex h-4 w-4 flex-shrink-0 items-center justify-center rounded-full text-indigo-400 hover:bg-indigo-200 hover:text-indigo-500 focus:bg-indigo-500 focus:text-white focus:outline-none">
            <span class="sr-only">Remove small option</span>
            <svg class="h-2 w-2" stroke="currentColor" fill="none" viewBox="0 0 8 8">
                <path stroke-linecap="round" stroke-width="1.5" d="M1 1l6 6m0-6L1 7" />
            </svg>
        </button>
    @endif
</span>
