<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class IjinSeeder extends Seeder
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
            DB::table('ijin_lingkungans')->insert([
                'il_nama' => $faker->company(),
                'il_nib' => $faker->randomNumber(5,true),
                'il_jenis_usaha' => $faker->jobTitle(),
                'il_penanggung_jawab' => $faker->name(),
                'il_alamat_pusat' => $faker->address(),
                'il_alamat_perwakilan' => $faker->address(),
                'il_alamat_cabang' => $faker->address(),
                'il_lokasi' => $faker->address(),
            ]);
        }
    }
}
