<div class="flex flex-col space-y-4">
    <x-input label="Nama rak" wire:model.lazy="inputs.name" :error="$errors->first('inputs.name')" />

    <x-textarea label="Deskripsi" wire:model.lazy="inputs.description" :error="$errors->first('inputs.description')" />
</div>
