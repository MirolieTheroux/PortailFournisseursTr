<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SupplierProductsServicesSeeder extends Seeder
{

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $suppliersPS = [];

        $suppliersPS[] = [
            'supplier_id' => 1,
            'products_services_code' => "10000000",
        ];
        $suppliersPS[] = [
            'supplier_id' => 1,
            'products_services_code' => "10100000",
        ];
        $suppliersPS[] = [
            'supplier_id' => 1,
            'products_services_code' => "10101500",
        ];
        $suppliersPS[] = [
            'supplier_id' => 1,
            'products_services_code' => "10101501",
        ];
        $suppliersPS[] = [
            'supplier_id' => 1,
            'products_services_code' => "10101502",
        ];
        $suppliersPS[] = [
            'supplier_id' => 1,
            'products_services_code' => "10101504",
        ];
        $suppliersPS[] = [
            'supplier_id' => 2,
            'products_services_code' => "10000000",
        ];
        $suppliersPS[] = [
            'supplier_id' => 2,
            'products_services_code' => "10100000",
        ];
        $suppliersPS[] = [
            'supplier_id' => 2,
            'products_services_code' => "10101500",
        ];
        $suppliersPS[] = [
            'supplier_id' => 3,
            'products_services_code' => "10101500",
        ];
        $suppliersPS[] = [
            'supplier_id' => 3,
            'products_services_code' => "10101600",
        ];
        $suppliersPS[] = [
            'supplier_id' => 3,
            'products_services_code' => "10101601",
        ];
        $suppliersPS[] = [
            'supplier_id' => 4,
            'products_services_code' => "10151803",
        ];

        $codes = [
            "10000000",
            "10100000",
            "10101500",
            "10101501",
            "10101502",
            "10101504",
            "10101600",
            "10101601",
            "10151803",
        ];

        for ($i = 5; $i <= 50; $i++) {
            $psNumber = rand(1,9);

            for($j = 0 ; $j < $psNumber ; $j++){
                $suppliersPS[] = [
                    'supplier_id' => $i,
                    'products_services_code' => $codes[$j],
                ];
            }

        }

        DB::table('supplier_products_services')->insert($suppliersPS);
    }
}
