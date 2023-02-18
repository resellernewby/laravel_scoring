<div class="flex flex-col space-y-4">
    <x-input label="Nama tag" wire:model.lazy="inputs.name" id="name" :error="$errors->first('inputs.name')" />
</div>
