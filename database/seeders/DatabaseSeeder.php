<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'name' => 'Super Admin',
                'email' => 'admin@technophoria.co.id',
                'level' => 9,
                'password' => bcrypt('123456'),

            ],
        ];



        foreach ($users as $key => $user) {

            User::create($user);
        }
    }
}
