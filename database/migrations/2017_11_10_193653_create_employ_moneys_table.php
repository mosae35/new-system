<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployMoneysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employ_moneys', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('hour');
            $table->integer('day');
            $table->integer('account');
            $table->string('month');
            $table->integer('year');
            $table->integer('employ_id');
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
        Schema::dropIfExists('employ_moneys');
    }
}
