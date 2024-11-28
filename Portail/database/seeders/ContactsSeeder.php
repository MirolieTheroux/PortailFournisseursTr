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
        $contacts = [];

        $contacts[] = [
            'id' => 1,
            'email' => 'bpitt@gmail.com',
            'first_name' => 'Brad',
            'last_name' => 'Pitt',
            'job' => 'Superviseur des opérations',
            'supplier_id' => 1,
        ];
        $contacts[] = [
            'id' => 2,
            'email' => 'mmonaghan@gmail.com',
            'first_name' => 'Michelle',
            'last_name' => 'Monaghan',
            'job' => 'Directrice des ventes',
            'supplier_id' => 1,
        ];
        $contacts[] = [
            'id' => 3,
            'email' => 'nfleurent@gmail.com',
            'first_name' => 'Nicolas',
            'last_name' => 'Fleurent',
            'job' => 'Developpeur',
            'supplier_id' => 2,
        ];
        $contacts[] = [
            'id' => 4,
            'email' => 'mtheroux@gmail.com',
            'first_name' => 'Mirolie',
            'last_name' => 'Theroux',
            'job' => 'Designeuse',
            'supplier_id' => 2,
        ];
        $contacts[] = [
            'id' => 5,
            'email' => 'jfaucher@gmail.com',
            'first_name' => 'Jérémy',
            'last_name' => 'Faucher',
            'job' => 'Developpeur',
            'supplier_id' => 3,
        ];
        $contacts[] = [
            'id' => 6,
            'email' => 'jdoe@gmail.com',
            'first_name' => 'John',
            'last_name' => 'Doe',
            'job' => 'Testeur',
            'supplier_id' => 4,
        ];
        
        $contactId = 7;
        for ($i = 5; $i <= 50; $i++) {
            $contacts[] = [
                'id' => $contactId,
                'email' => "employeEntreprise$i@gmail.com",
                'first_name' => rand(1,2) ? 'Michel' : 'John',
                'last_name' => rand(1,2) ? 'Tremblay' : 'Doe',
                'job' => rand(1,2) ? 'Testeur' : 'Démonstrateur',
                'supplier_id' => $i,
            ];
            $contactId++;
        }
        DB::table('contacts')->insert($contacts);
    }
}
