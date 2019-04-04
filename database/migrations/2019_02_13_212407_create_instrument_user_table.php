<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInstrumentUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('instrument_user', function (Blueprint $table) {
            $table->increments('id');
            $table->date('start_date');
            $table->string('note');
            $table->timestamps();

            $table->unsignedInteger('user_id');
            $table->unsignedInteger('instrument_id');
            $table->unique(['user_id','instrument_id']);

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('instrument_id')->references('id')->on('instruments');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('instrument_user');
    }
}
