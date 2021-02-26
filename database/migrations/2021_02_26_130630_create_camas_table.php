<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCamasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('camas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('cama');
            $table->integer('quantidade');
            $table->integer('ocupadas');
            $table->unsignedBigInteger('quarto_id')->unsigned();
            $table->foreign('quarto_id')->references('id')->on('quartos');
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
        Schema::dropIfExists('camas');
    }
}
