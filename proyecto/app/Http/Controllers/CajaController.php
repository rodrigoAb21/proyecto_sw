<?php

namespace App\Http\Controllers;

use App\Cuenta;
use App\Movimiento;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CajaController extends Controller
{
    public function nuevoPago(){
        if(Auth::user()->tipo == "Administrativo"){
            return view('caja.formulario');
        }else{
            return view('especiales.error');
        }
    }

    public function realizarPago(Request $request){
        $cuenta = DB::table('cuenta')
            ->where('nro', '=', $request->cuenta)
            ->first();

        try {
            DB::beginTransaction();

            $movimiento = new Movimiento();
            $movimiento->descripcion = "Deposito desde caja.";
            $movimiento->tipo = "DEPOSITO";
            $my_time = Carbon::now('America/La_Paz');
            $movimiento->fecha = $my_time -> getTimestamp();
            $movimiento->monto = $request->monto;
            $movimiento->cuenta_id = $cuenta->id;
            if ($movimiento->save()){
                $cuenta2 = Cuenta::findOrFail($cuenta->id);
                $cuenta2->saldo = $cuenta2->saldo + $request->monto;
                $cuenta2->save();
            };

            DB::commit();

        } catch (Exception $e) {
            DB::rollback();
        }

        return redirect('/pago');
    }
}
