<div wire:key="button-{{ $consumable->id }}" class="flex items-center justify-end space-x-4">
    <x-button.primary wire:click="addCart({{ $consumable->id }})" class="flex whitespace-nowrap items-center bg py-1">
        <x-icon.o-plus class="h-4 w-4 mr-1" /> Keranjang
    </x-button.primary>
    <x-button.secondary link="{{ route('consumable.edit', $consumable->id) }}"
        class="flex whitespace-nowrap items-center bg py-1">
        <x-icon.o-edit class="h-4 w-4 mr-1" /> Edit
    </x-button.secondary>
</div>
