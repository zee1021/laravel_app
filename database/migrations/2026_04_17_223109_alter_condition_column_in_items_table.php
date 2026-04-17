<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('items', function (Blueprint $table) {
            // Expand the enum to include your new conditions (must keep 'Used' for existing records)
            $table->enum('condition', ['New', 'Like New', 'Used', 'Used - Good', 'Used - Fair', 'Refurbished'])->change();
        });
    }

    public function down(): void
    {
        Schema::table('items', function (Blueprint $table) {
            // Revert back to the original strict enum values
            $table->enum('condition', ['New', 'Used'])->change();
        });
    }
};