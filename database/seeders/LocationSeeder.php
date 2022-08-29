<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LocationSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('locations')->insert([
            [
                'name' => 'SEKUM',
                'address' => 'Lorem ipsum dolor sit amet'
            ],
            [
                'name' => 'SATPAM',
                'address' => 'Lorem ipsum dolor sit amet'
            ],
            [
                'name' => 'HRD',
                'address' => 'Lorem ipsum dolor sit amet'
            ],
            [
                'name' => 'SARPRA',
                'address' => 'Lorem ipsum dolor sit amet'
            ],
            [
                'name' => 'Asrama',
                'address' => 'Lorem ipsum dolor sit amet'
            ],
            [
                'name' => 'AHA',
                'address' => 'Lorem ipsum dolor sit amet'
            ],
            [
                'name' => 'LabKom',
                'address' => 'Lorem ipsum dolor sit amet'
            ],
            [
                'name' => 'SMP',
                'address' => 'Lorem ipsum dolor sit amet'
            ],
            [
                'name' => 'SMA',
                'address' => 'Lorem ipsum dolor sit amet'
            ]
        ]);
    }
}
