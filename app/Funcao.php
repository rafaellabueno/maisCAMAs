<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Funcao extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'funcoes';

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
        'nome', 'descricao',
    ];

    public function users(){
        return $this->hasMany('App\User', 'funcao_id');
    }


}
