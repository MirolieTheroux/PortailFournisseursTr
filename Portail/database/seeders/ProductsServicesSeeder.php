<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductsServicesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('products_services')->insert([
            [
                'code' => "10000000",
                'description' => "TEST",
                'category_code' => "G1",
            ],
            [
                'code' => "10100000",
                'description' => "TEST",
                'category_code' => "G1",
            ],
            [
               'code' => "10101500",
                'description' => "TEST",
                'category_code' => "G1",
            ],
            [
                'code' => "10101501",
                'description' => "TEST",
                'category_code' => "G1",
            ],
            [
                'code' => "10101502",
                'description' => "TEST",
                'category_code' => "G1",
            ],
            [
                'code' => "10101504",
                'description' => "TEST",
                'category_code' => "G1",
            ],
            [
                'code' => "10101600",
                'description' => "TEST",
                'category_code' => "G1",
            ],
            [
                'code' => "10101601",
                'description' => "TEST",
                'category_code' => "G2",
            ],
            [
                'code' => "10151803",
                'description' => "TEST",
                'category_code' => "G2",
            ],
        ]);
    }
}
