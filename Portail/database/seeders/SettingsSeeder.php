<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\facades\DB;

class SettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('settings')->insert([
            [
                'id' => 1,
                'approbation_email' => "approver@vtr.net",
                'finance_email' => "finances@vtr.net",
                'file_max_size' => 75,
                'revision_delay' => 3,
            ],
        ]);
    }
}
