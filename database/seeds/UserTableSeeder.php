<?php

use Illuminate\Database\Seeder;
use App\User;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'lastname' => 'admin',
            'firstname' => 'admin',
            'email' =>'admin@gmail.com',
            'password' => 'admin',
            'is_admin' => true,
        ]);
        User::create([
            'lastname' => 'user',
            'firstname' => 'user',
            'email' => 'user@gmail.com',
            'password' => 'user',
            'is_admin' => false,
        ]);
    }
}
