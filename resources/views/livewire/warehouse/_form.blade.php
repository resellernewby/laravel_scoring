<div class="flex flex-col space-y-4">
    <x-input label="Nama gudang" wire:model.lazy="inputs.name" :error="$errors->first('inputs.name')" />

    <x-input label="Penanggung jawab" wire:model.lazy="inputs.pic" :error="$errors->first('inputs.pic')" />

    <x-textarea label="Deskripsi" wire:model.lazy="inputs.description" :error="$errors->first('inputs.description')" />
</div>
