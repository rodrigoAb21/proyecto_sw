<?php

namespace App\Http\Controllers;

use App\Cuenta;
use App\Movimiento;
use App\Serv_Usr;
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
        $nuevaFecha = new DateTime();
        $nuevaFecha -> setTimezone(new DateTimeZone('America/La_Paz'));

        $servicios = DB::table('serv_usr')
            ->join('servicio', 'servicio.id', '=', 'serv_usr.servicio_id')
            ->where('serv_usr.user_id','=', Auth::user()->id)
            ->where('serv_usr.estado', '=', 'En espera')
            ->select('servicio.id', 'servicio.fecha', 'servicio.estado', 'servicio.costo', 'servicio.sentido')
            ->orderBy('servicio.fecha', 'asc')
            ->paginate(5);


        foreach ($servicios as $servicio){
            $nuevaFecha -> setTimestamp($servicio -> fecha);
            $servicio -> fecha = $nuevaFecha -> format('d/m/Y, H:i');
        }

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

            // Se verifica si hay saldo y asiento disponible
            $cuenta = Cuenta::findOrFail(Auth::user()->cuenta_id);
            $servicio = Servicio::findOrFail($request -> servicio_id);
            if(($servicio -> cant_p > 0) && ($request -> monto < $cuenta -> saldo)){

                // Se crea un movimiento y se descuenta
                $movimiento = new Movimiento();
                $movimiento->descripcion = "Cobro de servicio con id: ".$request -> servicio_id;
                $movimiento->tipo = "COBRO";
                $my_time = Carbon::now('America/La_Paz');
                $movimiento->fecha = $my_time -> getTimestamp();
                $movimiento->monto = $request->monto;
                $movimiento->cuenta_id = $cuenta->id;

                // momento del descuento
                if ($movimiento->save()){
                    $cuenta-> saldo = $cuenta->saldo - $request->monto;
                    $cuenta-> save();
                };

                // Se crea un nuevo serv_usr
                $serv_usr = new Serv_Usr();
                $serv_usr -> longitud = $request -> longitud;
                $serv_usr -> latitud = $request -> latitud;
                $serv_usr -> monto = $request -> monto;
                $serv_usr -> servicio_id = $request -> servicio_id;
                $serv_usr -> user_id = Auth::user()->id;
                $serv_usr -> save();

                // Se cambia la cantidad de pasajeros disponibles del servicio
                $servicio -> cant_p = $servicio -> cant_p - 1;
                $servicio -> save();

            }else{

                // se debe enviar un mensaje de que no se cuenta con el saldo

            }

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
