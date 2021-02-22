<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReservaPessoaQuartoUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reserva_pessoa_quarto', function (Blueprint $table) {
            $table->unsignedBigInteger('pessoa_id');
            $table->unsignedBigInteger('reserva_id');
            $table->unsignedBigInteger('quarto_id')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->foreign('pessoa_id')->references('id')->on('pessoas');
            $table->foreign('reserva_id')->references('id')->on('reservas');
            $table->foreign('quarto_id')->references('id')->on('quartos');
            $table->foreign('user_id')->references('id')->on('users');
            $table->primary(['pessoa_id', 'reserva_id']);
            $table->unique(['pessoa_id', 'reserva_id']);
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
        Schema::dropIfExists('reserva_pessoa_quarto');
    }
}
