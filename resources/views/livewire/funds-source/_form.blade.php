<div class="flex flex-col space-y-4">
    <x-input label="Sumber dana" wire:model.lazy="inputs.name" :error="$errors->first('inputs.name')" />
    <x-input label="Kode" wire:model.lazy="inputs.code" :error="$errors->first('inputs.code')" />
</div>
