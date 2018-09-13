<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Servicio extends Model
{
    protected $table = 'servicio';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = [
        'sentido',
        'fecha',
        'estado',
        'cant_p',
        'costo',
        'user_id',
        'vehiculo_id',
        'ruta_id'
    ];
}
