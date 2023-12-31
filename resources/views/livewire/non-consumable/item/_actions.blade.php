<div wire:key="button-{{ $nonConsumable->id }}" class="flex items-center justify-end space-x-4">
    @switch($nonConsumable->current_status)
        @case('in_stock')
        @case('returned')
            <x-button.primary
                wire:click="$emit('openModal', 'non-consumable.item.checkout', {{ json_encode(['nonConsumable' => $nonConsumable->id]) }})"
                class="flex whitespace-nowrap items-center bg py-1">
                <x-icon.o-arrow-top-right-on-square class="h-4 w-4 mr-1" /> checkout
            </x-button.primary>
        @break

        @case('in_use')
            <x-button.secondary
                wire:click="$emit('openModal', 'non-consumable.item.set-action', {{ json_encode(['nonConsumable' => $nonConsumable->id]) }})"
                class="flex whitespace-nowrap items-center bg py-1">
                <x-icon.o-edit class="h-4 w-4 mr-1" /> tindakan
            </x-button.secondary>
        @break

        @default
            <a href="{{ route('damaged-asset.index') }}" class="text-red-700 hover:underline">Ke barang rusak</a>
    @endswitch
    <x-table.actions>
        <a href="#"
            wire:click.prevent="$emit('openModal', 'non-consumable.item.edit', {{ json_encode(['nonConsumable' => $nonConsumable->id]) }})"
            class="text-gray-700 block px-4 py-2 text-sm hover:bg-gray-100 cursor-pointer">
            Edit item
        </a>
        {{-- <a href="#" class="text-gray-700 block px-4 py-2 text-sm hover:bg-gray-100 cursor-pointer">
            Rincian item
        </a> --}}
        @if ($isDelete)
            <div class="px-4">
                <x-button.confirmation yes="destroy({{ $nonConsumable->id }})" no="$set('isDelete', false)" />
            </div>
        @else
            <div wire:click="$set('isDelete', true)"
                class="text-gray-700 block px-4 py-2 text-sm hover:bg-gray-100 cursor-pointer">
                Hapus item
            </div>
        @endif
    </x-table.actions>
</div>
