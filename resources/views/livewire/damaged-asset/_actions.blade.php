@php
    $acceptable = ['damaged', 'in_repair', 'returned'];
@endphp
@if (in_array($nonConsumable->current_status, $acceptable))
    <div wire:key="button-{{ $nonConsumable->id }}" class="flex items-center justify-end space-x-4">
        @switch($nonConsumable->current_status)
            @case('repair')
                <x-button.primary
                    wire:click="$emit('openModal', 'non-consumable.item.checkout', {{ json_encode(['nonConsumable' => $nonConsumable->id]) }})"
                    class="flex whitespace-nowrap items-center bg py-1">
                    <x-icon.o-arrow-top-right-on-square class="h-4 w-4 mr-1" /> Kembalikan ke stock
                </x-button.primary>
            @break

            @default
                <x-button.secondary
                    wire:click="$emit('openModal', 'damaged-asset.set-action', {{ json_encode(['nonConsumable' => $nonConsumable->id]) }})"
                    class="flex whitespace-nowrap items-center bg py-1">
                    <x-icon.o-edit class="h-4 w-4 mr-1" /> Tindakan
                </x-button.secondary>
        @endswitch
    </div>
@endif
