<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'username' => 'admin',
            'firstname' => 'Edvard',
            'lastname' => 'Khachatryan',
            'email' => 'edvard@navegatel.es',
            'rol' => 'Administrador',
            'password' => bcrypt('123')
        ]);
    }
}
