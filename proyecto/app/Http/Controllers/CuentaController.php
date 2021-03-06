<?php

namespace App\Http\Controllers;

use App\Cuenta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use DateTime;
use DateTimeZone;

class CuentaController extends Controller
{
    public function verMovimientos(){
        $movimientos = DB::table('movimiento')
            ->where('cuenta_id', '=', Auth::user()->cuenta_id)
            ->get();

        $cuenta = Cuenta::findOrFail(Auth::user()->cuenta_id);

        $nuevaFecha = new DateTime();
        $nuevaFecha -> setTimezone(new DateTimeZone('America/La_Paz'));

        foreach ($movimientos as $movimiento){
            $nuevaFecha -> setTimestamp($movimiento -> fecha);
            $movimiento -> fecha = $nuevaFecha -> format('d/m/Y, H:i');
        }

        return view('cartera.verMovimientos',['movimientos' => $movimientos, 'cuenta' => $cuenta]);
    }
}
