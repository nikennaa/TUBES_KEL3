<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
public function up()
{
    Schema::table('wedding_bookings', function (Blueprint $table) {
        $table->unsignedBigInteger('user_id')->nullable()->after('id');
        // Jangan tambahkan foreign key dulu agar tidak error
        // $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
    });
}

public function down()
{
    Schema::table('wedding_bookings', function (Blueprint $table) {
        $table->dropColumn('user_id');
    });
}

};
