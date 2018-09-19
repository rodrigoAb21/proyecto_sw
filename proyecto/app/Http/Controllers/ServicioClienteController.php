<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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

            $servicio = new Servicio();
            $servicio -> sentido = $request -> sentido;
            $servicio -> fecha = $request -> fecha ." ". $request -> hora;
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
