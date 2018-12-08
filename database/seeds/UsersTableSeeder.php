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
            'name' => 'Maksim',
            'email' => 'maksim_bender08@mail.com',
            'password' => bcrypt('password'),
            'role_id' => 1
        ]);
    }
}
