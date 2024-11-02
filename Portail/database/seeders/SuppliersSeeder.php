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
                'site' => "www.lignelleplus.inc",
                'product_service_detail' => "Vente d'uniformes pour femmes.",
                'tps_number' => "875567987",
                'tvq_number' => "764987364816576",
                'payment_condition' => "15daysNoDeduction",
                'currency' => 1,
                'communication_mode' => 1,
                'created_at' => '2024-06-01 21:35:24'
            ],
            [
                'id' => 2,
                'neq' => "1140039091",
                'name' => "EBÉNISTERIE DYCY",
                'password' => Hash::make('Secret1234!'),
                'email' => "test2@gmail.com",
                'site' => null,
                'product_service_detail' => null,
                'tps_number' => null,
                'tvq_number' => null,
                'payment_condition' => null,
                'currency' => null,
                'communication_mode' => null,
                'created_at' => '2024-06-01 21:35:24'
            ],
            [
                'id' => 3,
                'neq' => "1140000119",
                'name' => "LES GRAPHOIDES",
                'password' => Hash::make('Secret1234!'),
                'email' => "test3@gmail.com",
                'site' => null,
                'product_service_detail' => null,
                'tps_number' => null,
                'tvq_number' => null,
                'payment_condition' => null,
                'currency' => null,
                'communication_mode' => null,
                'created_at' => '2024-06-01 21:35:24'
            ],
            [
                'id' => 4,
                'neq' => "1140000606",
                'name' => "LINGERIE ULYSSE",
                'password' => Hash::make('Secret1234!'),
                'email' => "test4@gmail.com",
                'site' => null,
                'product_service_detail' => null,
                'tps_number' => null,
                'tvq_number' => null,
                'payment_condition' => null,
                'currency' => null,
                'communication_mode' => null,
                'created_at' => '2024-06-01 21:35:24'
            ],
            [
                'id' => 5,
                'neq' => null,
                'name' => "Test connection",
                'password' => Hash::make('Secret1234!'),
                'email' => "test5@gmail.com",
                'site' => null,
                'product_service_detail' => null,
                'tps_number' => null,
                'tvq_number' => null,
                'payment_condition' => null,
                'currency' => null,
                'communication_mode' => null,
                'created_at' => '2024-06-01 21:35:24'
            ],
        ]);
    }
}
