<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RbqLicenceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $licenceRbq = [];

        $licenceRbq[] = [
            'id' => 1,
            'number' => "1145678934",
            'status' => "valid",
            'type' => "entrepreneur",
            'supplier_id' => 1,
        ];
        $licenceRbq[] = [
            'id' => 2,
            'number' => "1145678935",
            'status' => "restrictedValid",
            'type' => "ownerBuilder",
            'supplier_id' => 2,
        ];
        $licenceRbq[] = [
            'id' => 3,
            'number' => "1145678936",
            'status' => "invalid",
            'type' => "entrepreneur",
            'supplier_id' => 3,
        ];

        $status = [
            "valid",
            "invalid",
            "restrictedValid",
        ];

        $type = [
            "ownerBuilder",
            "entrepreneur",
        ];

        $licenceId = 4;
        for ($i = 5; $i <= 50; $i++) {
            if($i % 2 == 0){
                $licenceRbq[] = [
                    'id' => $licenceId,
                    'number' => rand(1000000000, 9999999999),
                    'status' => $status[array_rand($status)],
                    'type' => $type[array_rand($type)],
                    'supplier_id' => $i,
                ];
                $licenceId++;
            }
        }

        DB::table('rbq_licences')->insert($licenceRbq);
    }
}
