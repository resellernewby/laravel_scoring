@props([
    'color' => 'gray',
    'text',
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
</span>
