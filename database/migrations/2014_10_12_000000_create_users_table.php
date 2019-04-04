<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nickname')->nullable();
            $table->string('name');
            $table->string('surname');
            $table->date('born_date');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('verify_token')->nullable();
            $table->timestamp('email_verified_at');
            $table->rememberToken();
            $table->integer('status');
            $table->decimal('lat',10,8);
            $table->decimal('lng',11,8);
            $table->string('place');
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
        Schema::dropIfExists('users');
    }
}
