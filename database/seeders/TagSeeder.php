<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tags')->insert([
            [
                'name' => 'Alat tulis',
                'slug' => 'alat-tulis',
            ],
            [
                'name' => 'Perkakas',
                'slug' => 'perkakas',
            ],
            [
                'name' => 'Elektronik',
                'slug' => 'elektronik',
            ],
            [
                'name' => 'Spare part',
                'slug' => 'spare-part',
            ],
            [
                'name' => 'Material',
                'slug' => 'material',
            ]
        ]);
    }
}
