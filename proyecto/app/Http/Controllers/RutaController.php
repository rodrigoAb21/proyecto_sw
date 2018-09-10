<?php

namespace App\Http\Controllers;

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
