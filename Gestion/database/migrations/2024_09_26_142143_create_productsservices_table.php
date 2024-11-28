<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products_services', function (Blueprint $table) {
            $table->string('code', 8)->primary();
            $table->string('description', 256);
            $table->string('category_code', 8);
            $table->foreign('category_code')
            ->references('code')
            ->on('products_services_categories') // Assuming your suppliers table is named 'suppliers'
            ->onDelete('cascade'); // Adjust this as needed for your case
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products_services');
    }
};
