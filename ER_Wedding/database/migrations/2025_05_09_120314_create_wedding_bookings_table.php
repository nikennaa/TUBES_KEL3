<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWeddingBookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wedding_bookings', function (Blueprint $table) {
            $table->id();  // ID untuk primary key
            $table->string('groom_name');
            $table->string('bride_name');
            $table->string('contact_phone');
            $table->string('contact_email');
            $table->date('wedding_date');
            $table->time('wedding_time');
            $table->string('venue_name');
            $table->string('venue_address');
            $table->integer('guest_count');
            $table->decimal('estimated_budget', 10, 2);
            $table->string('payment_method');
            $table->text('notes')->nullable();
            $table->json('services')->nullable();  // Untuk menyimpan layanan yang dipilih (misalnya dekorasi, catering)
            $table->timestamps();  // created_at dan updated_at
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('wedding_bookings');
    }
}
