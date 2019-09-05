<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Let's clear the users table first
        User::truncate();

        $faker = \Faker\Factory::create();
        // Create the admin user with admin as a password
        $password = Hash::make('admin');
        User::create([
            'name' => 'Administrator',
            'email' => 'admin@admin.com',
            'password' => $password
        ]);
    }
}
