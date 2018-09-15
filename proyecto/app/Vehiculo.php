<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vehiculo extends Model
{
    protected $table = 'vehiculo';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = [
        'placa',
        'marca',
        'modelo',
        'anho',
        'foto',
        'color',
        'visible',
        'capacidad',
        'user_id',

    ];
}
