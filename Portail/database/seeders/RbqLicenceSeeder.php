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
        DB::table('rbq_licences')->insert([
            [
                'id' => 1,
                'number' => "1145678934",
                'status' => "valid",
                'type' => "entrepreneur",
                'supplier_id' => 1,
            ],
            [
                'id' => 2,
                'number' => "1145678935",
                'status' => "restrictedValid",
                'type' => "ownerBuilder",
                'supplier_id' => 2,
            ],
            [
                'id' => 3,
                'number' => "1145678936",
                'status' => "invalid",
                'type' => "entrepreneur",
                'supplier_id' => 3,
            ],
        ]);
    }
}
