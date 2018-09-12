<?php

namespace App\Http\Controllers;

use App\Punto;
use App\Ruta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class RutaController extends Controller
{
    public function index()
    {
        $rutas = DB::table('ruta')
            ->where('user_id','=', Auth::user()->id)
            ->paginate(5);
        return view('rutas.index',['rutas' => $rutas]);
    }


    public function create()
    {
        return view('rutas.create');
    }


    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            $ruta = new Ruta();
            $ruta -> nombre = $request -> nombre;
            $ruta -> descripcion = $request -> descripcion;
            $ruta -> user_id = Auth::user()->id;
            $ruta -> save();


            $longitud = $request -> longitudT;
            $latitud = $request -> latitudT;
            $cont = 0;

            while ($cont < count($longitud)) {
                $punto = new Punto();
                $punto -> longitud = $longitud[$cont];
                $punto -> latitud = $latitud[$cont];
                $punto -> ruta_id = $ruta -> id;
                $punto -> save();
                $cont = $cont + 1;
            }

            DB::commit();
        }catch (Exception $e){
            DB::rollback();
        }

        return redirect('/rutas');
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
