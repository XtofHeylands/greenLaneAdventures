<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->truncate(); //wissen van gegevens uit tabel 
        DB::table('users')->insert([
        'profilepic' => $user->foto,
        'bio' => $user->bio
    ]);
    }
}
