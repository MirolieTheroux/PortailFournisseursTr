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
        DB::table('addresses')->insert([
            [
                'id' => 1,
                'civic_no' => "2707",
                'street' => "CAZENEUVE",
                'postal_code' => "H4R1Z7",
                'city' => "SAINT-LAURENT",
                'region' => "Bas-Saint-Laurent (01)",
                'province_id' => 9,
                'supplier_id' => 1,
            ],
            [
                'id' => 2,
                'civic_no' => "4082",
                'street' => "ch. Saint-Damien",
                'postal_code' => "G7X7V3",
                'city' => "SAGUENAY",
                'region' => "Saguenay-Lac-Saint-Jean (02)",
                'province_id' => 9,
                'supplier_id' => 2,
            ],
            [
                'id' => 3,
                'civic_no' => "791",
                'street' => "12e Rue",
                'postal_code' => "G1J2M9",
                'city' => "Québec",
                'region' => "Capitale-Nationale (03)",
                'province_id' => 9,
                'supplier_id' => 3,
            ],
            [
                'id' => 4,
                'civic_no' => "3121",
                'street' => "rue Deville",
                'postal_code' => "H1Z1Z6",
                'city' => "Montréal",
                'region' => "Montréal (06)",
                'province_id' => 9,
                'supplier_id' => 4,
            ],
        ]);
    }
}
