<?php

namespace App\Http\Controllers;

use App\Mensaje;
use DateTime;
use DateTimeZone;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MensajeController extends Controller
{
    function index(){
        $mensajes = DB::table('mensaje')
            ->where('user_id', '=', Auth::user()->id)
            ->orderBy('fecha', 'asc')
            ->paginate(10);

        $nuevaFecha = new DateTime();
        $nuevaFecha -> setTimezone(new DateTimeZone('America/La_Paz'));

        foreach ($mensajes as $mensaje){
            $nuevaFecha -> setTimestamp($mensaje -> fecha);
            $mensaje -> fecha = $nuevaFecha -> format('d/m/Y');
        }

        return view('mensajes.index', ['mensajes' => $mensajes]);

    }

    function show($id){
        $mensaje = Mensaje::findOrFail($id);
        $nuevaFecha = new DateTime();
        $nuevaFecha -> setTimezone(new DateTimeZone('America/La_Paz'));

        $nuevaFecha -> setTimestamp($mensaje -> fecha);
        $mensaje -> fecha = $nuevaFecha -> format('d/m/Y');

        return view('mensajes.show', ['mensaje' => $mensaje]);
    }

}
