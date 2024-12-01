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
        $statusHistories = [];

        $statusHistories[] = [
            'id' => 1,
            'status' => "waiting",
            'updated_by' => "test1@gmail.com",
            'refusal_reason' => null,
            'supplier_id' => 1,
            'created_at' => '2024-05-30 08:00:00'
        ];
        $statusHistories[] = [
            'id' => 2,
            'status' => "accepted",
            'updated_by' => "nic@vtr.com",
            'refusal_reason' => null,
            'supplier_id' => 1,
            'created_at' => '2024-06-15 09:30:25'
        ];
        $statusHistories[] = [
            'id' => 3,
            'status' => "waiting",
            'updated_by' => "test2@gmail.com",
            'refusal_reason' => null,
            'supplier_id' => 2,
            'created_at' => '2024-06-01 21:35:24'
        ];
        $statusHistories[] = [
            'id' => 4,
            'status' => "modified",
            'updated_by' => "test2@gmail.com",
            'refusal_reason' => null,
            'supplier_id' => 2,
            'created_at' => '2024-06-01 22:35:24'
        ];
        $statusHistories[] = [
            'id' => 5,
            'status' => "denied",
            'updated_by' => "nic@vtr.com",
            'refusal_reason' => Crypt::encrypt("Dossier criminel"),
            'supplier_id' => 2,
            'created_at' => '2024-11-15 09:50:25'
        ];
        $statusHistories[] = [
            'id' => 6,
            'status' => "modified",
            'updated_by' => "nic@vtr.com",
            'refusal_reason' => null,
            'supplier_id' => 2,
            'created_at' => '2024-12-10 10:10:10'
        ];
        $statusHistories[] = [
            'id' => 7,
            'status' => "denied",
            'updated_by' => "nic@vtr.com",
            'refusal_reason' => Crypt::encrypt("Permis non valide"),
            'supplier_id' => 2,
            'created_at' => '2024-02-07 08:29:10'
        ];
        $statusHistories[] = [
            'id' => 8,
            'status' => "waiting",
            'updated_by' => "test3@gmail.com",
            'refusal_reason' => null,
            'supplier_id' => 3,
            'created_at' => '2024-06-03 06:15:55'
        ];
        $statusHistories[] = [
            'id' => 9,
            'status' => "modified",
            'updated_by' => "test3@gmail.com",
            'refusal_reason' => null,
            'supplier_id' => 3,
            'created_at' => '2024-06-04 21:35:24'
        ];
        $statusHistories[] = [
            'id' => 10,
            'status' => "denied",
            'updated_by' => "nic@vtr.com",
            'refusal_reason' => Crypt::encrypt("Ne correspond pas au discussion au téléphone."),
            'supplier_id' => 4,
            'created_at' => '2024-06-15 09:50:25'
        ];
        $statusHistories[] = [
            'id' => 11,
            'status' => "modified",
            'updated_by' => "test4@gmail.com",
            'refusal_reason' => null,
            'supplier_id' => 4,
            'created_at' => '2024-06-15 15:25:25'
        ];
        $statusHistories[] = [
            'id' => 12,
            'status' => "toCheck",
            'updated_by' => "Système",
            'refusal_reason' => null,
            'supplier_id' => 4,
            'created_at' => '2024-06-15 15:25:25'
        ];

        $statusId = 13;
        for ($i = 5; $i <= 50; $i++) {
            $numberOfStatus = rand(1,3);

            $secondStatus = '';
            for ($j = 1; $j <= $numberOfStatus; $j++) {
                $status;
                $updatedBy;
                $refusalReason = null;
                $createdAt;
                if($j == 1){
                    $status = 'waiting';
                    $updatedBy = "entreprise$i@example.com";
                    $createdAt = '2024-06-01 15:25:25';
                }
                else if($j == 2){
                    $status = rand(1,2) == 1 ? 'accepted' : 'denied';
                    $updatedBy = "admin@vtr.net";
                    $secondStatus = $status;
                    if($status == 'denied'){
                        $refusalReason = Crypt::encrypt("Ne répond pas aux critères.");
                    }
                    $createdAt = '2024-06-02 15:25:25';
                }
                else{
                    if($secondStatus == 'accepted'){
                        $status = 'deactivated';
                        $updatedBy = rand(1,2) == 1 ? "entreprise$i@example.com" : "admin@vtr.net";
                    }
                    else{
                        $status = 'toCheck';
                        $updatedBy = "Système";
                    }
                    $createdAt = '2024-06-03 15:25:25';
                }

                //ajouter statut
                $statusHistories[] = [
                    'id' => $statusId,
                    'status' => $status,
                    'updated_by' => $updatedBy,
                    'refusal_reason' => $refusalReason,
                    'supplier_id' => $i,
                    'created_at' => $createdAt
                ];

                $statusId++;
            }
        }
        DB::table('status_histories')->insert($statusHistories);
    }
}
