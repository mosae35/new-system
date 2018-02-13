<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOutProcessesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('out_processes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('doctor');
            $table->string('name');
            $table->string('type');
            $table->string('client');
            $table->string('place');
            $table->float('cash')->unsigned();
            $table->float('in_cash')->unsigned();
            $table->integer('user_id');
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
        Schema::dropIfExists('out_processes');
    }
}
