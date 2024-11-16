<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\facades\DB;
use Illuminate\Support\facades\Hash;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('app_gestion_users')->insert([
            [
                'id' => 1,
                'email' => 'admin@gmail.com',
                'password' => Hash::make('Secret1234!'),
                'role' => 'admin'
            ],
            [
                'id' => 2,
                'email' => 'responsable@gmail.com',
                'password' => Hash::make('Secret1234!'),
                'role' => 'responsable'
            ],
            [
                'id' => 3,
                'email' => 'commis@gmail.com',
                'password' => Hash::make('Secret1234!'),
                'role' => 'clerk'
            ],
        ]);
    }
}
