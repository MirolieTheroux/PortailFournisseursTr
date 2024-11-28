<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(UsersSeeder::class);
        $this->call(ProductsservicescategoriesTableSeeder::class);
        // User::factory(10)->create();
        $this->call(ProductsServicesSeeder::class);
        $this->call(WorkSubcategoriesSeeder::class);
        $this->call(ProvincesSeeder::class);
        $this->call(SuppliersSeeder::class);
        $this->call(AdressesSeeder::class);
        $this->call(ContactsSeeder::class);
        $this->call(PhoneNumbersSeeder::class);
        $this->call(AttachmentsSeeder::class);
        $this->call(RbqLicenceSeeder::class);
        $this->call(SupplierWorkSubcategorySeeder::class);
        $this->call(SupplierProductsServicesSeeder::class);
        $this->call(StatusHistoriesSeeder::class);
        $this->call(EmailModelsSeeder::class);
        $this->call(ModificationCategoriesSeeder::class);
    }
}
