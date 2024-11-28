<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdressesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $adresses = [];

        $adresses[] = [
            'id' => 1,
            'civic_no' => "2707",
            'street' => "CAZENEUVE",
            'postal_code' => "H4R1Z7",
            'city' => "Saint-Laurent-de-l'Île-d'Orléans",
            'region' => "Bas-Saint-Laurent (01)",
            'province_id' => 9,
            'supplier_id' => 1,
        ];
        $adresses[] = [
            'id' => 2,
            'civic_no' => "4082",
            'street' => "ch. Saint-Damien",
            'postal_code' => "G7X7V3",
            'city' => "SAGUENAY",
            'region' => "Saguenay-Lac-Saint-Jean (02)",
            'province_id' => 9,
            'supplier_id' => 2,
        ];
        $adresses[] = [
            'id' => 3,
            'civic_no' => "791",
            'street' => "12e Rue",
            'postal_code' => "G1J2M9",
            'city' => "Québec",
            'region' => "Capitale-Nationale (03)",
            'province_id' => 9,
            'supplier_id' => 3,
        ];
        $adresses[] = [
            'id' => 4,
            'civic_no' => "3121",
            'street' => "rue Deville",
            'postal_code' => "H1Z1Z6",
            'city' => "Montréal",
            'region' => "Montréal (06)",
            'province_id' => 9,
            'supplier_id' => 4,
        ];
        
        $postalCodes = [];
        $letters = range('A', 'Z');
        $numbers = range(0, 9);

        for ($i = 5; $i <= 50; $i++) {
            $postalCode = sprintf(
                '%s%d%s%d%s%d',
                $letters[array_rand($letters)], // Première lettre
                $numbers[array_rand($numbers)], // Premier chiffre
                $letters[array_rand($letters)], // Deuxième lettre
                $numbers[array_rand($numbers)], // Deuxième chiffre
                $letters[array_rand($letters)], // Troisième lettre
                $numbers[array_rand($numbers)]  // Troisième chiffre
            );

            $city;
            $region;
            $province;
            switch(rand(1,3)){
                case 1:
                    $city = "Trois-Rivières";
                    $region = "Mauricie (04)";
                    $province = 9;
                    break;
                case 2:
                    $city = "Montréal";
                    $region = "Montréal (06)";
                    $province = 9;
                    break;
                case 3:
                    $city = "Ville $i";
                    $region = null;
                    $province = 3;
                    break;
            }

            $adresses[] = [
                'id' => $i,
                'civic_no' => rand(100,9999),
                'street' => "rue de l'entreprise $i",
                'postal_code' => $postalCode,
                'city' => $city,
                'region' => $region,
                'province_id' => $province,
                'supplier_id' => $i,
            ];
        }

        DB::table('addresses')->insert($adresses);
    }
}
