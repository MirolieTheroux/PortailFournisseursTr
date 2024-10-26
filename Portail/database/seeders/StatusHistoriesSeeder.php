<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\facades\DB;
use Illuminate\Support\facades\Carbon;
use Illuminate\Support\facades\Crypt;

class StatusHistoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('status_histories')->insert([
            [
                'id' => 1,
                'status' => "En attente",
                'updated_by' => "test1@gmail.com",
                'refusal_reason' => null,
                'supplier_id' => 1,
                'created_at' => '2024-05-30 08:00:00'
            ],
            [
                'id' => 2,
                'status' => "Acceptée",
                'updated_by' => "nic@vtr.com",
                'refusal_reason' => null,
                'supplier_id' => 1,
                'created_at' => '2024-06-15 09:30:25'
            ],
            [
                'id' => 3,
                'status' => "En attente",
                'updated_by' => "test2@gmail.com",
                'refusal_reason' => null,
                'supplier_id' => 2,
                'created_at' => '2024-06-01 21:35:24'
            ],
            [
                'id' => 4,
                'status' => "Modifiée",
                'updated_by' => "test2@gmail.com",
                'refusal_reason' => null,
                'supplier_id' => 2,
                'created_at' => '2024-06-01 22:35:24'
            ],
            [
                'id' => 5,
                'status' => "Refusée",
                'updated_by' => "nic@vtr.com",
                'refusal_reason' => Crypt::encrypt("Dossier criminel"),
                'supplier_id' => 2,
                'created_at' => '2024-06-15 09:50:25'
            ],
            [
                'id' => 6,
                'status' => "En attente",
                'updated_by' => "test3@gmail.com",
                'refusal_reason' => null,
                'supplier_id' => 3,
                'created_at' => '2024-06-03 06:15:55'
            ],
            [
                'id' => 7,
                'status' => "En attente",
                'updated_by' => "test4@gmail.com",
                'refusal_reason' => null,
                'supplier_id' => 4,
                'created_at' => '2024-06-01 21:35:24'
            ],
            [
                'id' => 8,
                'status' => "Refusée",
                'updated_by' => "nic@vtr.com",
                'refusal_reason' => Crypt::encrypt("Ne correspond pas au discussion au téléphone."),
                'supplier_id' => 4,
                'created_at' => '2024-06-15 09:50:25'
            ],
            [
                'id' => 9,
                'status' => "Modifiée",
                'updated_by' => "test4@gmail.com",
                'refusal_reason' => null,
                'supplier_id' => 4,
                'created_at' => '2024-06-15 15:25:25'
            ],
            [
                'id' => 10,
                'status' => "À réviser",
                'updated_by' => "système",
                'refusal_reason' => null,
                'supplier_id' => 4,
                'created_at' => '2024-06-15 15:25:25'
            ],
        ]);
    }
}
