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
        Schema::table('wedding_bookings', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->nullable()->after('id'); // ✅ Tambahkan ini
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('wedding_bookings', function (Blueprint $table) {
            $table->dropColumn('user_id'); // ✅ Tambahkan ini juga
        });
    }
};
