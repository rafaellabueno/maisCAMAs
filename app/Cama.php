<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cama extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'camas';

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
        'cama', 'quantidade', 'ocupadas', 'quarto_id',
    ];
}
