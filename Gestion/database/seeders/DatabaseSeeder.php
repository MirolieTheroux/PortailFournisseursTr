<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(UsersSeeder::class);
        $this->call(ProductsservicescategoriesTableSeeder::class);
        $this->call(ProductsServicesSeeder::class);
        $this->call(WorkSubcategoriesSeeder::class);
        $this->call(ProvincesSeeder::class);
        $this->call(EmailModelsSeeder::class);
        $this->call(ModificationCategoriesSeeder::class);
    }
}
