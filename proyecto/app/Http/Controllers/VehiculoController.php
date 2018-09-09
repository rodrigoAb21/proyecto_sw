<?php

namespace App\Http\Controllers;

use App\Vehiculo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class VehiculoController extends Controller
{

    public function index()
    {
        $vehiculos = DB::table('vehiculo')
            ->where('user_id', '=', Auth::user()->id)
            ->paginate(5);
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
        $vehiculo->color = $request->color;
        $vehiculo->capacidad = $request->capacidad;
        $vehiculo->update();

        return redirect('/vehiculos');
    }


    public function destroy($id)
    {
        //
    }
}
