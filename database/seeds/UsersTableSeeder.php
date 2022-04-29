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
        \App\User::create([
            'name'  => 'Administrator',
            'email' => 'admin123@gmail.com',
            'role' => 'admin',
            'password'  => bcrypt('123456')
        ]);
    }
}
