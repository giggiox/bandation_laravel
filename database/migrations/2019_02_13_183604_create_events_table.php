<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->string('description');
            $table->date('event_date');
            $table->time('start_hour');
            $table->time('end_hour');

            $table->decimal('lat',10,8);
            $table->decimal('lng',11,8);
            $table->string('place');

            $table->unsignedInteger('group_user_id');
            $table->foreign('group_user_id')->references('id')->on('group_user');

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
        Schema::dropIfExists('events');
    }
}
