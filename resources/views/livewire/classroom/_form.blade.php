<div class="flex flex-col space-y-4">
    <x-input label="Nama Kelas" wire:model.lazy="inputs.name" :error="$errors->first('inputs.name')" />
    <div class="w-full">
        <x-select label="Status" wire:model.lazy="inputs.is_active" :list="$status" :error="$errors->first('inputs.is_active')" />
    </div>
</div>
