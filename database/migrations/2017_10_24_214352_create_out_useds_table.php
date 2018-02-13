<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOutUsedsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('out_useds', function (Blueprint $table) {
            $table->increments('id');
            $table->tinyInteger('process');
            $table->string('type');
            $table->string('size');
            $table->integer('num');
            $table->float('cic');
            $table->integer('process_id');
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
        Schema::dropIfExists('out_useds');
    }
}
