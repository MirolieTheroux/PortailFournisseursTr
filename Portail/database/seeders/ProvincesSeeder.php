<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\facades\DB;

class ProvincesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('provinces')->insert([
            [
                'id' => 1,
                'name' => "Alberta",
            ],
            [
                'id' => 2,
                'name' => "Colombie-Britannique",
            ],
            [
                'id' => 3,
                'name' => "Île-du-Prince-Édouard",
            ],
            [
                'id' => 4,
                'name' => "Manitoba",
            ],
            [
                'id' => 5,
                'name' => "Nouveau-Brunswick",
            ],
            [
                'id' => 6,
                'name' => "Nouvelle-Écosse",
            ],
            [
                'id' => 7,
                'name' => "Nunavut",
            ],
            [
                'id' => 8,
                'name' => "Ontario",
            ],
            [
                'id' => 9,
                'name' => "Québec",
            ],
            [
                'id' => 10,
                'name' => "Saskatchewan",
            ],
            [
                'id' => 11,
                'name' => "Terre-Neuve-et-Labrador",
            ],
            [
                'id' => 12,
                'name' => "Territoires du Nord-Ouest",
            ]
        ]);
    }
}
