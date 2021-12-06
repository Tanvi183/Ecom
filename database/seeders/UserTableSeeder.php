<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            // Admin
            [
                'full_name' => 'site admin',
                'username'  => 'Admin',
                'email'     => 'admin@gmail.com',
                'password'  => Hash::make('12345678'),
                'role'      => 'admin',
                'status'    => 'active',
            ],
            // vendor
            [
                'full_name' => 'vendor183',
                'username'  => 'vendor',
                'email'     => 'vendor@gmail.com',
                'password'  => Hash::make('12345678'),
                'role'      => 'vendor',
                'status'    => 'active',
            ],
            // Customer
            [
                'full_name' => 'Customer183',
                'username'  => 'Customer',
                'email'     => 'Customer@gmail.com',
                'password'  => Hash::make('12345678'),
                'role'      => 'customer',
                'status'    => 'active',
            ],
        ]);
    }
}
