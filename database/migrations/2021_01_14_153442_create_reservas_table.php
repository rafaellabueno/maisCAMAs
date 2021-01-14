<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReservasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('data_entrada');
            $table->date('data_saida');
            $table->string('especialidade');
            $table->string('observacao')->nullable();
            $table->boolean('acessibilidade');
            $table->boolean('crianca');
            $table->string('status');
            $table->string('urgencia');
            $table->string('situacao_quarto')->nullable();
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
        Schema::dropIfExists('reservas');
    }
}
