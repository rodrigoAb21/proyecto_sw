<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Punto extends Model
{
    protected $table = 'punto';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = [
        'longitud',
        'latitud',
        'ruta_id'
    ];


}
