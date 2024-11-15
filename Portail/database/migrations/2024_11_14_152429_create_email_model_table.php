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
        Schema::create('email_model', function (Blueprint $table) {
            $table->id();
            $table->string('name', 64)->unique();
            $table->string('Object', 128);
            $table->string('title', 50);
            $table->string('description', 100);
            $table->string('subtitle', 50);
            $table->string('icon', 128);
            $table->string('state', 50);
            $table->string('message', 500);
            $table->string('footer', 200);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('Email_Model');
    }
};
