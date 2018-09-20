<?php

namespace App\Http\Controllers;

use App\Servicio;
use DateTime;
use DateTimeZone;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ServicioController extends Controller
{

    // Estados = En espera, En curso, Finalizado, Cancelado

    public function index()
    {
        $servicios = DB::table('servicio')
            ->join('vehiculo', 'servicio.vehiculo_id', '=', 'vehiculo.id')
            ->join('ruta', 'servicio.ruta_id', '=', 'ruta.id')
            ->where('servicio.user_id','=', Auth::user()->id)
            ->where('servicio.estado', '=', 'En espera')
            ->select('servicio.id','servicio.fecha', 'vehiculo.placa as vehiculo', 'servicio.sentido', 'servicio.estado',
                'servicio.cant_p', 'servicio.costo', 'ruta.nombre as ruta')
            ->paginate(5);

        return view('servicios.ofrecer.index',['servicios' => $servicios]);
    }


    public function create()
    {
        $id = Auth::user()->id;
        $rutas = DB::table('ruta')
            ->where('visible', '=', '1')
            ->where('user_id','=', $id)
            ->get();
        $vehiculos = DB::table('vehiculo')
            ->where('visible', '=', '1')
            ->where('user_id', '=', $id)
            ->get();
        $sentidos = ['Ida a la U', 'Retorno de la U'];

        return view('servicios.ofrecer.create', ['rutas' => $rutas, 'vehiculos' => $vehiculos, 'sentidos' => $sentidos]);
    }


    public function store(Request $request)
    {
        try {
            DB::beginTransaction();

            $servicio = new Servicio();
            $servicio -> sentido = $request -> sentido;
            $dia = new DateTime($request->fecha." ".$request->hora, new DateTimeZone('America/La_Paz'));
            $servicio -> fecha = $dia -> getTimestamp();
            $servicio -> estado = 'En espera';
            $servicio -> cant_p = $request -> cant_p;
            $servicio -> costo = $request -> costo;
            $servicio -> user_id = Auth::user() -> id;
            $servicio -> vehiculo_id = $request -> vehiculo_id;
            $servicio -> ruta_id = $request -> ruta_id;
            $servicio -> save();

            /*
                Se deberia ver lo del pago...
                un intermediario que acumule lo que reciba de los clientes
                 que contratan el servicio de id:XXX y al momento de rendir
                el "informe" este inserte la suma total a la cuenta del chofer
            */

            DB::commit();
        }catch (Exception $e){
            DB::rollback();
        }

        return redirect('/servicio/ofrecer');
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
}
