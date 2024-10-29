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
                'size' => '30',
                'deposit_date' => Carbon::create('2024', '10', '22'),
                'supplier_id' => 1,
            ],
            [
                'id' => 2,
                'name' => 'carteAffaire',
                'type' => 'jpeg',
                'size' => '60',
                'deposit_date' => Carbon::create('2000', '09', '10'),
                'supplier_id' => 1,
            ],
        ]);
    }
}