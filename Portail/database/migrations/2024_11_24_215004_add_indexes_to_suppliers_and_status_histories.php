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
        Schema::table('suppliers_and_status_histories', function (Blueprint $table) {
            Schema::table('addresses', function (Blueprint $table) {
                $table->index('supplier_id'); // Ajoute un index simple sur la colonne 'supplier_id'
            });
        
            Schema::table('status_histories', function (Blueprint $table) {
                $table->index('status'); // Ajoute un index sur la colonne 'status'
                $table->index('created_at'); // Ajoute un index sur la colonne 'created_at'
                $table->index(['status', 'created_at']); // Index composite
            });
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('suppliers_and_status_histories', function (Blueprint $table) {
            Schema::table('addresses', function (Blueprint $table) {
                $table->dropIndex(['supplier_id']); // Supprime l'index sur 'supplier_id'
            });
        
            Schema::table('status_histories', function (Blueprint $table) {
                $table->dropIndex(['status']);
                $table->dropIndex(['created_at']);
                $table->dropIndex(['status', 'created_at']);
            });
        });
    }
};
