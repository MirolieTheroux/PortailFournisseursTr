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
        Schema::create('suppliers', function (Blueprint $table) {
            $table->id();
            $table->string('neq', 10)->unique()->nullable();
            $table->string('name', 64);
            $table->string('password', 128);
            $table->string('email', 64);
            $table->string('site', 64)->nullable();
            $table->string('product_service_detail', 500)->nullable();
            $table->string('tps_number', 15)->nullable();
            $table->string('tvq_number', 16)->nullable();
            $table->string('payment_condition', 64)->nullable();
            $table->integer('currency')->nullable();
            $table->integer('communication_mode')->nullable();
            $table->rememberToken();
            $table->timestamps();
            $table->unique(['neq','email']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('suppliers');
    }
};
