<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ContactsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('contacts')->insert([
            [
                'id' => 1,
                'email' => 'bpitt@gmail.com',
                'first_name' => 'Brad',
                'last_name' => 'Pitt',
                'job' => 'Superviseur des opérations',
                'supplier_id' => 1,
            ],
            [
                'id' => 2,
                'email' => 'mmonaghan@gmail.com',
                'first_name' => 'Michelle',
                'last_name' => 'Monaghan',
                'job' => 'Directrice des ventes',
                'supplier_id' => 1,
            ],
        ]);
    }
}
