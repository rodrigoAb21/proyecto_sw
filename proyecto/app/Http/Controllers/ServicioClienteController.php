<?php

namespace App\Http\Controllers;

use App\Servicio;
use App\User;
use App\Vehiculo;
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
            ->where('sentido','=', $request -> sentido)
            ->get();

        // de acuerdo a la latitud y longitud senhalada armar un area limite cuadradada alrededor de 500mts


        $longitud = $request -> longitud;
        $latitud = $request -> latitud;

        $lat_max = $latitud + 0.01;
        $lat_min = $latitud - 0.01;

        $lng_max = $longitud + 0.005;
        $lng_min = $longitud - 0.005;

        $nuevaFecha = new DateTime();
        $nuevaFecha -> setTimezone(new DateTimeZone('America/La_Paz'));

        $cc = count($servicios_dia);
        while ($cc > 0){
            $nuevaFecha -> setTimestamp($servicios_dia[$cc-1] -> fecha);
            $servicios_dia[$cc-1] -> fecha = $nuevaFecha -> format('H:i');

            $dentro = $this->dentro($lat_max, $lat_min, $lng_max, $lng_min, $servicios_dia[$cc-1] -> ruta_id);
            if (!$dentro){
                unset($servicios_dia[$cc-1]);
            }
            $cc--;
        }


        return view('servicios.solicitar.resultados', ['servicios' => $servicios_dia]);
    }

    public function dentro($lat_max, $lat_min, $lng_max, $lng_min, $ruta_id){
        $puntos = DB::table('punto')
            ->where('ruta_id', '=', $ruta_id)
            ->get();

        foreach ($puntos as $punto){
            $lat = $punto->latitud;
            $lng = $punto->longitud;

            if(($lat <= $lat_max) && ($lat>=$lat_min)){
                if (($lng <= $lng_max) && ($lng >= $lng_min)){
                    return true;
                }
            }
        }
        return false;
    }

    public function detalle($id){
        $servicio = Servicio::findOrFail($id);

        $nuevaFecha = new DateTime();
        $nuevaFecha -> setTimezone(new DateTimeZone('America/La_Paz'));
        $nuevaFecha -> setTimestamp($servicio -> fecha);
        $servicio -> fecha = $nuevaFecha -> format('H:i');

        $conductor = User::findOrFail($servicio->user_id);
        $vehiculo = Vehiculo::findOrFail($servicio -> vehiculo_id);
        $puntos = DB::table('punto')
            ->where('ruta_id', '=', $servicio -> ruta_id)
            ->orderBy('id','asc')
            ->get();

        return view('servicios.solicitar.detalle', ['servicio' => $servicio, 'conductor' => $conductor, 'vehiculo' => $vehiculo, 'puntos' => $puntos]);
    }
}
