<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\facades\Hash;

class SuppliersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('suppliers')->insert([
            [
                'id' => 1,
                'neq' => "1140030355",
                'name' => "LIGN'ELLE PLUS INC.",
                'password' => Hash::make('Secret1234!'),
                'email' => "test1@gmail.com",
            ],
            [
                'id' => 2,
                'neq' => "1140039091",
                'name' => "EBÉNISTERIE DYCY",
                'password' => Hash::make('Secret1234!'),
                'email' => "test2@gmail.com",
            ],
            [
                'id' => 3,
                'neq' => "1140000119",
                'name' => "LES GRAPHOIDES",
                'password' => Hash::make('Secret1234!'),
                'email' => "test3@gmail.com",
            ],
            [
                'id' => 4,
                'neq' => "1140000606",
                'name' => "LINGERIE ULYSSE",
                'password' => Hash::make('Secret1234!'),
                'email' => "test4@gmail.com",
            ],
        ]);
    }
}
