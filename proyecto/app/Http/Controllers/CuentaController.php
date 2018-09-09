<?php

namespace App\Http\Controllers;

use App\Cuenta;
use App\Movimiento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CuentaController extends Controller
{
    public function verMovimientos(){
        $movimientos = DB::table('movimiento')
            ->where('cuenta_id', '=', Auth::user()->cuenta_id)
            ->paginate(5);

        $cuenta = Cuenta::findOrFail(Auth::user()->cuenta_id);

        return view('cartera.verMovimientos',['movimientos' => $movimientos, 'cuenta' => $cuenta]);
    }
}
