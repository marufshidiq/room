<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAgendasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agendas', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('room_id');
            $table->string('name');
            $table->string('pic')->nullable();
            $table->string('email')->nullable();
            $table->string('contact')->nullable();
            $table->dateTime('start');
            $table->dateTime('end');
            $table->enum('listrik', ['0', '1'])->default('0');
            $table->enum('ac', ['0', '1'])->default('0');
            $table->enum('proyektor', ['0', '1'])->default('0');
            $table->string('token')->nullable();
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
        Schema::dropIfExists('agendas');
    }
}
