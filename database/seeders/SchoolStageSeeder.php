<?php

namespace Database\Seeders;

use App\Models\SchoolStage;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SchoolStageSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        SchoolStage::insert([
            'id' => 1,
            'name' => 'TA',
            'description' => 'Tarbiyatul Aulad',
            'priority' => '1',
        ]);

        SchoolStage::insert([
            'id' => 2,
            'name' => 'MT Baniin',
            'description' => '',
            'priority' => '2',
        ]);

        SchoolStage::insert([
            'id' => 3,
            'name' => 'MT Banaat',
            'description' => '',
            'priority' => '2',
        ]);
    }
}
