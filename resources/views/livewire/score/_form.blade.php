<div class="flex flex-col space-y-4">
    <div class="w-full">
        <x-select label="Kelas" wire:model.lazy="inputs.classroom_id" :list="$classroomLists" :error="$errors->first('inputs.classroom_id')" />
    </div>
    <x-input type="number" label="Nilai Lantai" wire:model.lazy="inputs.scoring_floor" :error="$errors->first('inputs.scoring_floor')" />
    <x-input type="number" label="Nilai Meja" wire:model.lazy="inputs.scoring_table" :error="$errors->first('inputs.scoring_table')" />
    <x-input type="number" label="Nilai Peralatan" wire:model.lazy="inputs.scoring_equipment" :error="$errors->first('inputs.scoring_equipment')" />
    <div>
        <x-input.date label="Tanggal" wire:model.lazy="inputs.scoring_date" :error="$errors->first('inputs.scoring_date')" />
    </div>
</div>
