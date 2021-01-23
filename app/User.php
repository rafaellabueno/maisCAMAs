<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Funcao;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'funcao_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    static function findByEmail($email) {
        return User::where('email', $email)->first();
    }

    public function temFuncao ($funcao){
        if($funcao == \Auth::user()->funcoes->nome){
            return true;
        }
        else {
            return false;
        }
    }

    public function funcoes(){
        return $this->belongsTo('App\Funcao','funcao_id');
    }

}
