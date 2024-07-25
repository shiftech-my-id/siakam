<?php

namespace Database\Seeders;

use App\Models\SchoolGrade;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SchoolGradeSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::beginTransaction();

        SchoolGrade::insert([
            'id' => 1,
            'name' => 'TA - A',
            'stage_id' => 1
        ]);

        SchoolGrade::insert([
            'id' => 2,
            'name' => 'TA - B',
            'stage_id' => 1
        ]);

        for ($i = 1; $i <= 6; $i++) {
            SchoolGrade::insert([
                'name' => 'MT Baniin - ' . $i,
                'stage_id' => 2
            ]);

            SchoolGrade::insert([
                'name' => 'MT Banaat - ' . $i,
                'stage_id' => 3
            ]);
        }
        //

        DB::commit();
    }
}
