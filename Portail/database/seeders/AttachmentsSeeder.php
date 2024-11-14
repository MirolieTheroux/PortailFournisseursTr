<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AttachmentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('attachments')->insert([
            [
                'id' => 1,
                'name' => 'monDepliant',
                'type' => 'pdf',
                'size' => '25',
                'deposit_date' => Carbon::create('2024', '10', '22'),
                'supplier_id' => 1,
            ],
            [
                'id' => 2,
                'name' => 'carteAffaire',
                'type' => 'jpeg',
                'size' => '16',
                'deposit_date' => Carbon::create('2000', '09', '10'),
                'supplier_id' => 1,
            ],
            [
                'id' => 3,
                'name' => 'PortailFournisseur',
                'type' => 'pdf',
                'size' => '5',
                'deposit_date' => Carbon::create('2000', '09', '10'),
                'supplier_id' => 4,
            ],
            [
                'id' => 4,
                'name' => 'anphiteatre',
                'type' => 'jpg',
                'size' => '81',
                'deposit_date' => Carbon::create('2000', '09', '10'),
                'supplier_id' => 4,
            ],
        ]);
    }
}
