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
        Schema::create('email_models', function (Blueprint $table) {
            $table->id();
            $table->string('name', 64)->unique();
            $table->string('object', 128);
            $table->string('title', 50);
            $table->string('description', 100)->nullable();
            $table->string('subtitle', 50)->nullable();
            $table->string('icon', 128)->nullable();
            $table->string('state', 50)->nullable();
            $table->string('message', 500)->nullable();
            $table->string('footer', 200)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('email_models');
    }
};
