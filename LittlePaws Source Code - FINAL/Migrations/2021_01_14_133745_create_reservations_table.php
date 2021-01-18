<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReservationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservations', function (Blueprint $table) {
            $table->id('bookID');     
            $table->unsignedBigInteger('userID');
            $table->unsignedBigInteger('hotelID');
            $table->foreign('userID')->references('userID')->on('users');
            $table->foreign('hotelID')->references('hotelID')->on('hotels');

            $table->integer('petQty');
            $table->date('checkInDate');
            $table->date('checkOutDate');
            $table->string('payMethod');
            $table->decimal('payAmt', $precision = 8, $scale = 2);
            
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
        Schema::dropIfExists('reservations');
    }
}
