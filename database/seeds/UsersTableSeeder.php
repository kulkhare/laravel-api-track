<?php

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
        DB::table('users')->insert([
            'name' => 'kul',
            'role' => 1, // admin
            'email' => 'kul@test.com',
            'password' => bcrypt('password'), // password
        ]);
    }
}
