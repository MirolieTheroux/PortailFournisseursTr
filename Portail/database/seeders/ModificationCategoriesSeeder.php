<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ModificationCategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('modification_categories')->insert([
            [
                'id' => 1,
                'category' => "Identification",
            ],
            [
                'id' => 2,
                'category' => "Coordonnées",
            ],
            [
                'id' => 3,
                'category' => "Contacts",
            ],
            [
                'id' => 4,
                'category' => "Produits et services",
            ],
            [
                'id' => 5,
                'category' => "Licence RBQ",
            ],
            [
                'id' => 6,
                'category' => "Pièces jointes",
            ],
            [
                'id' => 7,
                'category' => "Finances",
            ],
        ]);
    }
}
