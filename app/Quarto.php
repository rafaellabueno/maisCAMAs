<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Quarto extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'quartos';

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
        'andar', 'descricao', 'numero', 'status', 'cama', 'observacao',
    ];
}
