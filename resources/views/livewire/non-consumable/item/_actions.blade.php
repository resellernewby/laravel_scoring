<div wire:key="button-{{ $nonConsumable->id }}" class="flex items-center justify-end space-x-4">
    <x-button.primary wire:click="checkout({{ $nonConsumable->id }})" class="flex whitespace-nowrap items-center bg py-1">
        <x-icon.o-arrow-uturn-right class="h-4 w-4 mr-1" /> checkout
    </x-button.primary>
    <x-table.actions>
        <a href="{{ route('non-consumable.edit', $nonConsumable->id) }}"
            class="text-gray-700 block px-4 py-2 text-sm hover:bg-gray-100 cursor-pointer">
            Edit
        </a>
        <div wire:click="addMoreTags({{ $nonConsumable->id }})"
            class="text-gray-700 block px-4 py-2 text-sm hover:bg-gray-100 cursor-pointer">
            <span wire:loading.remove wire:target="addMoreTags({{ $nonConsumable->id }})">
                Tambah kategori
            </span>
            <span wire:loading wire:target="addMoreTags({{ $nonConsumable->id }})">Processing...</span>
        </div>
        <a href="{{ route('non-consumable.show', $nonConsumable->id) }}"
            class="text-gray-700 block px-4 py-2 text-sm hover:bg-gray-100 cursor-pointer">
            Rincian
        </a>
        @if ($isDelete)
            <div class="px-4">
                <x-button.confirmation yes="destroy({{ $nonConsumable->id }})" no="$set('isDelete', false)" />
            </div>
        @else
            <div wire:click="$set('isDelete', true)"
                class="text-gray-700 block px-4 py-2 text-sm hover:bg-gray-100 cursor-pointer">
                Hapus
            </div>
        @endif
    </x-table.actions>
</div>
