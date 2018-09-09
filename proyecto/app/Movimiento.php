<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Movimiento extends Model
{
    protected $table = 'movimiento';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = [
        'descripcion',
        'tipo',
        'fecha',
        'monto',
        'cuenta_id'

    ];

    public static $TIPOS = ['DEPOSITO', 'COBRO DE SERVICIO', 'MULTA'];
}
