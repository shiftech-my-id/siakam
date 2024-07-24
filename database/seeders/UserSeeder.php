<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        User::truncate();
        Schema::enableForeignKeyConstraints();

        User::insert([
            'username' => 'admin',
            'fullname' => 'Administrator',
            'password' => Hash::make('12345'),
            'active' => true,
            'role' => User::ADMINISTRATOR,
            'remember_token' => Str::random(10),
        ]);

        User::insert([
            'username' => 'operator',
            'fullname' => 'Operator',
            'password' => Hash::make('12345'),
            'active' => true,
            'role' => User::OPERATOR,
            'remember_token' => Str::random(10),
        ]);

        // $faker = \Faker\Factory::create('id_ID');
        // DB::beginTransaction();
        // $pw = Hash::make('12345');
        // for ($i = 3; $i <= 100; $i++) {
        //     User::insert([
        //         'id' => $i,
        //         'username' => 'user' . $i,
        //         'password' => $pw,
        //         'is_active' => rand(0, 1),
        //         'is_admin' => rand(0, 1),
        //         'fullname' => $faker->name(),
        //         'group_id' => rand(1, 2),
        //     ]);
        // }
        // DB::commit();
    }
}
