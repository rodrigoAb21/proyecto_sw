<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Serv_Usr extends Model
{
    protected $table = 'serv_usr';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = [
        'servicio_id',
        'user_id',
        'estado',
        'monto'
    ];

}