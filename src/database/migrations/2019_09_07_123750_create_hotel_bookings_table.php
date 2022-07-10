<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHotelBookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hotel_bookings', function (Blueprint $table) {
            $table->bigIncrements('book_id');
            $table->string('name');
            $table->string('email')->nullable();
            $table->string('address');
            $table->string('phone');
            $table->integer('guest_adult');
            $table->integer('guest_children')->nullable();
            $table->integer('hotel_id');
            $table->integer('room_id');
            $table->float('price',10,2);
            $table->dateTime('chekin_date');
            $table->dateTime('checkout_date');
            $table->integer('status');
            $table->string('booked_by');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('hotel_bookings');
    }
}
