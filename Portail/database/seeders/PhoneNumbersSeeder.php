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
                'extension' => null,
                'contact_id' => null,
                'supplier_id' => 1,
            ],
            [
                'id' => 2,
                'number' => "8192223333",
                'type' => "Cellulaire",
                'extension' => null,
                'contact_id' => null,
                'supplier_id' => 1,
            ],
            [
                'id' => 3,
                'number' => "8191112222",
                'type' => "Bureau",
                'extension' => "222",
                'contact_id' => 1,
                'supplier_id' => null,
            ],
            [
                'id' => 4,
                'number' => "8194445555",
                'type' => "Cellulaire",
                'extension' => null,
                'contact_id' => 2,
                'supplier_id' => null,
            ],
            [
                'id' => 5,
                'number' => "5145555555",
                'type' => "Télécopieur",
                'extension' => null,
                'contact_id' => 1,
                'supplier_id' => null,
            ],
            [
                'id' => 6,
                'number' => "8191119999",
                'type' => "Bureau",
                'extension' => "999",
                'contact_id' => 2,
                'supplier_id' => null,
            ],
            [
                'id' => 7,
                'number' => "8191119999",
                'type' => "Bureau",
                'extension' => null,
                'contact_id' => 3,
                'supplier_id' => null,
            ],
            [
                'id' => 8,
                'number' => "8191119999",
                'type' => "Bureau",
                'extension' => null,
                'contact_id' => 4,
                'supplier_id' => null,
            ],
            [
                'id' => 9,
                'number' => "8191119999",
                'type' => "Bureau",
                'extension' => null,
                'contact_id' => 5,
                'supplier_id' => null,
            ],
            [
                'id' => 10,
                'number' => "8191119999",
                'type' => "Bureau",
                'extension' => null,
                'contact_id' => 6,
                'supplier_id' => null,
            ],
            [
                'id' => 11,
                'number' => "8191119999",
                'type' => "Bureau",
                'extension' => null,
                'contact_id' => null,
                'supplier_id' => 2,
            ],
            [
                'id' => 12,
                'number' => "8191119999",
                'type' => "Bureau",
                'extension' => null,
                'contact_id' => null,
                'supplier_id' => 3,
            ],
            [
                'id' => 13,
                'number' => "8191119999",
                'type' => "Bureau",
                'extension' => null,
                'contact_id' => null,
                'supplier_id' => 4,
            ],
        ]);
    }
}
