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
        $suppliers = [];

        $suppliers[] = [
            'id' => 1,
            'neq' => "1140030355",
            'name' => "LIGN'ELLE PLUS INC.",
            'password' => Hash::make('Secret1234!'),
            'email' => "test1@gmail.com",
            'site' => "www.lignelleplus.inc",
            'product_service_detail' => "Vente d'uniformes pour femmes.",
            'tps_number' => "123456789RT0001",
            'tvq_number' => "1234567890TQ0001",
            'payment_condition' => "15daysNoDeduction",
            'currency' => 2,
            'communication_mode' => 2,
            'created_at' => '2024-06-01 21:35:24'
        ];
        $suppliers[] = [
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
        ];
        $suppliers[] = [
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
        ];
        $suppliers[] = [
            'id' => 4,
            'neq' => null,
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
        ];

        for ($i = 5; $i <= 50; $i++) {
            $neqPrefix = ['11', '22', '33', '88'][($i - 1) % 4];
            $neq = $i % 5 === 0 ? null : $neqPrefix . str_pad($i, 8, '0', STR_PAD_LEFT);

            $suppliers[] = [
                'id' => $i,
                'neq' => $neq,
                'name' => "Entreprise $i",
                'password' => Hash::make("Secret1234!"),
                'email' => "entreprise$i@example.com",
                'site' => $i % 3 === 0 ? "www.entreprise$i.com" : null,
                'product_service_detail' => $i % 2 === 0 ? "Description du produit ou service pour l'entreprise $i." : null,
                'tps_number' => str_pad($i, 9, '0', STR_PAD_LEFT) . "RT0001",
                'tvq_number' => str_pad($i, 10, '0', STR_PAD_LEFT) . "TQ0001",
                'payment_condition' => $i % 2 === 0 ? '30daysNet' : 'CashOnDelivery',
                'currency' => $i % 15 === 0 ? 2 : 1,
                'communication_mode' => $i % 7 === 0 ? 2 : 1,
                'created_at' => '2024-06-01 21:35:24',
            ];
        }

        DB::table('suppliers')->insert($suppliers);
    }
}
