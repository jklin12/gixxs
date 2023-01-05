<?php

namespace Database\Seeders;

use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class KesSeeder extends Seeder
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
            DB::table('kawasan_ekosistem_esensials')->insert([
                'kes_nama' => $faker->name(),
                'kes_file' => '',
                'created_at' => $faker->date(),
            ]);
        }
    }
}
