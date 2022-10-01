<div class="flex flex-col space-y-4">
    <x-input label="Nama merek" wire:model.lazy="inputs.name" :error="$errors->first('inputs.name')" />
</div>
