<div class="flex flex-col space-y-4">
    <x-input label="Nama Suplier" wire:model.lazy="inputs.name" :error="$errors->first('inputs.name')" />
    <x-input label="No. HP" wire:model.lazy="inputs.phone" :error="$errors->first('inputs.phone')" />
    <x-input label="Email" wire:model.lazy="inputs.email" :error="$errors->first('inputs.email')" />
    <x-textarea label="Alamat" wire:model.lazy="inputs.address" :error="$errors->first('inputs.address')" />
</div>
