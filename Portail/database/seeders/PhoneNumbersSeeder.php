<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\facades\DB;

class PhoneNumbersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('phone_numbers')->insert([
            [
                'id' => 1,
                'number' => "8195556666",
                'type' => "Bureau",
                'supplier_id' => 1,
            ],
            [
                'id' => 2,
                'number' => "8192223333",
                'type' => "Cellulaire",
                'supplier_id' => 1,
            ],
        ]);
    }
}
