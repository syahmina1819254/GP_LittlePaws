<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdoptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('adoptions', function (Blueprint $table) {
            $table->id('adoptID');
            $table->unsignedBigInteger('userID')->nullable();
            $table->unsignedBigInteger('petID')->nullable();
            $table->foreign('userID')->references('userID')->on('users');
            $table->foreign('petID')->references('petID')->on('pets');
            
            $table->date('reqDate');
            $table->string('reqStatus');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('adoptions');
    }
}
