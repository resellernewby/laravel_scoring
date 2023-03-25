<div class="flex items-center justify-end space-x-4">
    <x-button.primary wire:click="addCart({{ $consumable->id }})"
        class="flex whitespace-nowrap items-center bg py-1 pl-2.5">
        <x-icon.o-plus class="h-4 w-4 mr-1" /> Keranjang
    </x-button.primary>
    <x-table.actions id="row-{{ $consumable->id }}">
        <a href="{{ route('consumable.edit', $consumable->id) }}"
            class="text-gray-700 block px-4 py-2 text-sm hover:bg-gray-100 cursor-pointer">
            Edit
        </a>
        <div wire:click="addMoreTags({{ $consumable->id }})"
            class="text-gray-700 block px-4 py-2 text-sm hover:bg-gray-100 cursor-pointer">
            <span wire:loading.remove wire:target="addMoreTags({{ $consumable->id }})">
                Tambah kategori
            </span>
            <span wire:loading wire:target="addMoreTags({{ $consumable->id }})">Processing...</span>
        </div>
        <a href="{{ route('consumable.show', $consumable->id) }}"
            class="text-gray-700 block px-4 py-2 text-sm hover:bg-gray-100 cursor-pointer">
            Detail
        </a>
        @if ($isDelete)
            <div class="px-4">
                <x-button.confirmation yes="destroy({{ $consumable->id }})" no="$set('isDelete', false)" />
            </div>
        @else
            <div wire:click="$set('isDelete', true)"
                class="text-gray-700 block px-4 py-2 text-sm hover:bg-gray-100 cursor-pointer">
                Hapus
            </div>
        @endif
    </x-table.actions>
</div>
