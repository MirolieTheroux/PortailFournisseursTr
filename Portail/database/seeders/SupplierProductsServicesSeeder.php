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
        DB::table('supplier_products_services')->insert([
            [
                'supplier_id' => 1,
                'products_services_code' => "10000000",
            ],
            [
                'supplier_id' => 1,
                'products_services_code' => "10100000",
            ],
            [
                'supplier_id' => 1,
                'products_services_code' => "10101500",
            ],
            [
                'supplier_id' => 1,
                'products_services_code' => "10101501",
            ],
            [
                'supplier_id' => 1,
                'products_services_code' => "10101502",
            ],
            [
                'supplier_id' => 1,
                'products_services_code' => "10101504",
            ],
            [
                'supplier_id' => 2,
                'products_services_code' => "10000000",
            ],
            [
                'supplier_id' => 2,
                'products_services_code' => "10100000",
            ],
            [
                'supplier_id' => 2,
                'products_services_code' => "10101500",
            ],
            [
                'supplier_id' => 3,
                'products_services_code' => "10101500",
            ],
            [
                'supplier_id' => 3,
                'products_services_code' => "10101600",
            ],
            [
                'supplier_id' => 3,
                'products_services_code' => "10101601",
            ],
            [
                'supplier_id' => 4,
                'products_services_code' => "10151803",
            ],
        ]);
    }
}
