<?php

namespace App\Http\Controllers;

use App\Vehiculo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;

class VehiculoController extends Controller
{

    public function index()
    {
        $vehiculos = DB::table('vehiculo')
            ->where('user_id', '=', Auth::user()->id)
            ->where('visible', '=', '1')
            ->get();
        return view('vehiculos.index', ['vehiculos' => $vehiculos]);
    }


    public function create()
    {
        return view('vehiculos.create');
    }


    public function store(Request $request)
    {
        $vehiculo = new Vehiculo();
        $vehiculo->placa = $request->placa;
        $vehiculo->marca = $request->marca;
        $vehiculo->modelo = $request->modelo;
        $vehiculo->anho = $request->anho;
        $vehiculo->color = $request->color;

        if (Input::hasFile('foto')) {
            $file = Input::file('foto');
            $file->move(public_path() . '/img/vehiculos/' .$request->placa . '/', $file->getClientOriginalName());
            $vehiculo->foto = $file->getClientOriginalName();
        }


        $vehiculo->capacidad = $request->capacidad;
        $vehiculo->user_id = Auth::user()->id;
        $vehiculo->save();

        return redirect('/vehiculos');
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        $vehiculo = Vehiculo::findOrFail($id);
        return view('vehiculos.edit',['vehiculo' => $vehiculo]);
    }


    public function update(Request $request, $id)
    {
        $vehiculo = Vehiculo::findOrFail($id);
        $vehiculo->placa = $request->placa;
        $vehiculo->marca = $request->marca;
        $vehiculo->modelo = $request->modelo;
        $vehiculo->anho = $request->anho;

        if (Input::hasFile('foto')) {
            $file = Input::file('foto');
            $file->move(public_path() . '/img/vehiculos/' .$request->placa . '/', $file->getClientOriginalName());
            $vehiculo->foto = $file->getClientOriginalName();
        }

        $vehiculo->color = $request->color;
        $vehiculo->capacidad = $request->capacidad;
        $vehiculo->save();

        return redirect('/vehiculos');
    }


    public function destroy($id)
    {
        $vehiculo = Vehiculo::findOrFail($id);
        $vehiculo->visible = '0';
        $vehiculo->update();

        return redirect('/vehiculos');
    }
}
