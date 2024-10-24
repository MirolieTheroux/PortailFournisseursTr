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
                'description' => "Plantes et animaux vivants, accessoires et fournitures",
                'category_code' => "G22",
            ],
            [
                'code' => "10100000",
                'description' => "Animaux vivants",
                'category_code' => "G22",
            ],
            [
               'code' => "10101500",
                'description' => "Animaux d'élevage",
                'category_code' => "G22",
            ],
            [
                'code' => "10101501",
                'description' => "Chat",
                'category_code' => "G22",
            ],
            [
                'code' => "10101502",
                'description' => "Chien",
                'category_code' => "G22",
            ],
            [
                'code' => "10101504",
                'description' => "Vison",
                'category_code' => "G22",
            ],
            [
                'code' => "10101600",
                'description' => "Oiseaux et volailles",
                'category_code' => "G22",
            ],
            [
                'code' => "10101601",
                'description' => "Poulets vivants",
                'category_code' => "G22",
            ],
            [
                'code' => "10151803",
                'description' => "Graines ou semis de cannelle",
                'category_code' => "G22",
            ],
        ]);
    }
}
