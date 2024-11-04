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
            [
                'id' => 3,
                'email' => 'nfleurent@gmail.com',
                'first_name' => 'Nicolas',
                'last_name' => 'Fleurent',
                'job' => 'Developpeur',
                'supplier_id' => 2,
            ],
            [
                'id' => 4,
                'email' => 'mtheroux@gmail.com',
                'first_name' => 'Mirolie',
                'last_name' => 'Theroux',
                'job' => 'Designeuse',
                'supplier_id' => 2,
            ],
            [
                'id' => 5,
                'email' => 'jfaucher@gmail.com',
                'first_name' => 'Jérémy',
                'last_name' => 'Faucher',
                'job' => 'Developpeur',
                'supplier_id' => 3,
            ],
            [
                'id' => 6,
                'email' => 'jdoe@gmail.com',
                'first_name' => 'John',
                'last_name' => 'Doe',
                'job' => 'Testeur',
                'supplier_id' => 4,
            ],
        ]);
    }
}
