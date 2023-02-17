<div class="flex flex-col space-y-4">
    <x-input label="Lokasi" wire:model.lazy="inputs.name" :error="$errors->first('inputs.name')" />
    <x-textarea label="Alamat (opsional)" wire:model.lazy="inputs.address" :error="$errors->first('inputs.address')" />
</div>
