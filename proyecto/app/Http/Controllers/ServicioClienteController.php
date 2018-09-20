<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use DateTimeZone;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use DateTime;

class ServicioClienteController extends Controller
{
    // Estados = En espera, En curso, Finalizado, Cancelado

    public function index()
    {
        $servicios = DB::table('serv_usr')
            ->join('servicio', 'servicio.id', '=', 'serv_usr.servicio_id')
            ->where('serv_usr.user_id','=', Auth::user()->id)
            ->where('serv_usr.estado', '=', 'En espera')
            ->select('servicio.id', 'servicio.fecha', 'servicio.estado', 'servicio.costo')
            ->orderBy('servicio.fecha', 'asc')
            ->paginate(5);

        return view('servicios.solicitar.index',['servicios' => $servicios]);
    }


    public function create()
    {
        $sentidos = ['Ida a la U', 'Retorno de la U'];

        return view('servicios.solicitar.busqueda', ['sentidos' => $sentidos]);
    }


    public function store(Request $request)
    {
        try {
            DB::beginTransaction();


            DB::commit();
        }catch (Exception $e){
            DB::rollback();
        }

        return redirect('/servicio/solicitar');
    }


    public function show($id){

    }


    public function edit($id)
    {

    }


    public function update(Request $request, $id)
    {

    }


    public function destroy($id)
    {

    }


    public function buscar(Request $request){
        // transformando la fecha del formulario a entero
        $dia = new DateTime($request->fecha." ".$request->hora, new DateTimeZone('America/La_Paz'));
        $dia = $dia ->getTimestamp();

        // recuperando todos los servicios que se encuentre +- 1hr de la fecha
        $servicios_dia = DB::table('servicio')
            ->whereBetween('fecha', [($dia - 3600),($dia + 3600)])
            ->get();

        // de acuerdo a la latitud y longitud senhalada armar un area limite cuadradada alrededor de 500mts

        dd($servicios_dia);
    }
}
