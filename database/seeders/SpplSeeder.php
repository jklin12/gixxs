<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;


class SpplSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('id_ID');

        for ($i = 1; $i <= 10; $i++) {
            DB::table('sppls')->insert([
                'sppl_name' => $faker->name(),
                'sppl_file' => '',
                'created_at' => $faker->date(),
            ]);
        }
    }
}
