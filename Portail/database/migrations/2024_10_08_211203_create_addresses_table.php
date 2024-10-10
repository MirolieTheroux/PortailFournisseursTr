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
        Schema::create('addresses', function (Blueprint $table) {
            $table->id();
            $table->string('civic_no', 8);
            $table->string('street', 64);
            $table->string('office', 8);
            $table->string('postal_code', 6);
            $table->string('city', 64);
            $table->string('region', 64)->nullable();
            $table->foreignId('province_id')->constrained('provinces');
            $table->foreignId('supplier_id')->constrained('suppliers');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('addresses');
    }
};
