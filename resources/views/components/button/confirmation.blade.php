@props([
'yes' => '',
'no' => ''
])
<span class="relative z-0 inline-flex shadow-sm rounded-md">
    <button type="button" wire:click="{{ $yes }}" title="Ya"
        class="relative inline-flex items-center px-2 py-2 rounded-l-md text-white text-sm font-medium bg-red-500 hover:bg-red-300 focus:z-10 focus:outline-none focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500">
        <span class="sr-only">Yes</span>
        <x-icon.o-check class="h-5 w-5" />
    </button>
    <button type="button" wire:click="{{ $no }}" title="Tidak"
        class="-ml-px relative inline-flex items-center px-2 py-2 rounded-r-md text-white text-sm font-medium bg-green-500 hover:bg-green-300 focus:z-10 focus:outline-none focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500">
        <span class="sr-only">No</span>
        <x-icon.o-x class="h-5 w-5" />
    </button>
</span>
