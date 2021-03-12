<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reserva extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'reservas';

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $schema = 'public';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'data_entrada', 'data_saida', 'especialidade', 'observacao',  'acessibilidade', 'crianca', 'status',
        'urgencia', 'situacao_quarto', 'paciente',  'nome_paciente', 'observacao_recusa', 'quant_hospedes'
    ];
}
