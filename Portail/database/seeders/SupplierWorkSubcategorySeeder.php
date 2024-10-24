<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SupplierWorkSubcategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('supplier_work_subcategory')->insert([
            [
                'supplier_id' => 1,
                'work_subcategory_id' => 1,
            ],
            [
                'supplier_id' => 1,
                'work_subcategory_id' => 2,
            ],
            [
                'supplier_id' => 1,
                'work_subcategory_id' => 21,
            ],
            [
                'supplier_id' => 1,
                'work_subcategory_id' => 16,
            ],
            [
                'supplier_id' => 2,
                'work_subcategory_id' => 1,
            ],
            [
                'supplier_id' => 2,
                'work_subcategory_id' => 2,
            ],
            [
                'supplier_id' => 3,
                'work_subcategory_id' => 1,
            ],
        ]);
    }
}
