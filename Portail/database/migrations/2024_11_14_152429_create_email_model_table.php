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
            $table->string('titleText', 50)->nullable();
            $table->integer('titleSize');
            $table->string('titleColor', 7);
            $table->boolean('ButtonIsActive');
            $table->string('ButtonUrl', 512);
            $table->string('ButtonText', 50);
            $table->string('ButtonTextColor', 7);
            $table->string('ButtonBackgroundColor', 7);
            $table->string('DescriptionText', 100)->nullable();
            $table->integer('DescriptionSize');
            $table->string('DescriptionColor', 7);
            $table->string('HeaderBackgroundUrl', 512)->nullable();
            $table->string('SubtitleText', 50)->nullable();
            $table->integer('SubtitleSize');
            $table->string('SubtitleColor', 7);
            $table->string('iconUrl', 512)->nullable();
            $table->integer('iconSize');
            $table->string('ImportantInfoText', 50)->nullable();
            $table->integer('ImportantInfoSize');
            $table->string('ImportantInfoColor', 7);
            $table->string('passwordResetButtonText', 50);
            $table->string('passwordResetButtonColor', 7);
            $table->string('passwordResetButtonBackgroundColor', 7);
            $table->longText('messageText')->nullable();
            $table->integer('messageSize');
            $table->string('messageColor', 7);
            $table->string('BackgroundColor', 7);
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
