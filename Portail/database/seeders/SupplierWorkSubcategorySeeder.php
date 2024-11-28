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
        $categories = [];

        $categories[] = [
            'supplier_id' => 1,
            'work_subcategory_id' => 1,
        ];
        $categories[] = [
            'supplier_id' => 1,
            'work_subcategory_id' => 2,
        ];
        $categories[] = [
            'supplier_id' => 1,
            'work_subcategory_id' => 21,
        ];
        $categories[] = [
            'supplier_id' => 1,
            'work_subcategory_id' => 16,
        ];
        $categories[] = [
            'supplier_id' => 2,
            'work_subcategory_id' => 1,
        ];
        $categories[] = [
            'supplier_id' => 2,
            'work_subcategory_id' => 2,
        ];
        $categories[] = [
            'supplier_id' => 3,
            'work_subcategory_id' => 1,
        ];

        for ($i = 5; $i <= 50; $i++) {
            if($i % 2 == 0){
                $categorieNumber = rand(1,11);
                for($j = 1 ; $j <= $categorieNumber ; $j++){
                    $categories[] = [
                        'supplier_id' => $i,
                        'work_subcategory_id' => $j,
                    ];
                }
            }
        }
        DB::table('supplier_work_subcategory')->insert($categories);
    }
}
