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
            $table->string('logoUrl', 512)->nullable();
            $table->integer('logoSize');
            $table->string('titleText', 64)->nullable();
            $table->integer('titleSize');
            $table->string('titleColor', 7);
            $table->string('buttonUrl', 512)->nullable();
            $table->string('buttonText', 50)->nullable();
            $table->string('buttonTextColor', 7);
            $table->string('buttonBackgroundColor', 7);
            $table->string('descriptionText', 100)->nullable();
            $table->integer('descriptionSize');
            $table->string('descriptionColor', 7);
            $table->string('headerBackgroundUrl', 512)->nullable();
            $table->string('subtitleText', 50)->nullable();
            $table->integer('subtitleSize');
            $table->string('subtitleColor', 7);
            $table->string('iconUrl', 512)->nullable();
            $table->integer('iconSize');
            $table->string('importantInfoText', 50)->nullable();
            $table->integer('importantInfoSize');
            $table->string('importantInfoColor', 7);
            $table->string('passwordResetButtonText', 50)->nullable();
            $table->string('passwordResetButtonColor', 7);
            $table->string('passwordResetButtonBackgroundColor', 7);
            $table->longText('messageText')->nullable();
            $table->integer('messageSize');
            $table->string('messageColor', 7);
            $table->string('footerText', 256)->nullable();
            $table->integer('footerSize');
            $table->string('footerColor', 7);
            $table->string('footerBackgroundUrl', 512)->nullable();
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
