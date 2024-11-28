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
        Schema::create('account_modifications', function (Blueprint $table) {
            $table->id();
            $table->string('changed_attribute', 64)->nullable();
            $table->foreignId('category_id')->constrained('modification_categories');
            $table->foreignId('status_id')->constrained('status_histories');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('account_modifications');
    }
};
