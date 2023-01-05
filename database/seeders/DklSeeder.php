<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class DklSeeder extends Seeder
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
            DB::table('dokumen_kajian_lingkungans')->insert([
                'dkl_nama' => $faker->name(),
                'dkl_file' => '',
                'created_at' => $faker->date(),
            ]);
        }
    }
}
