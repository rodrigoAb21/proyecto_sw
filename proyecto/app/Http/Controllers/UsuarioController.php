<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;

class UsuarioController extends Controller
{
    public function editar(){
        $usuario = User::findOrFail(Auth::user()->id);
        return view('usuarios.edit', ['usuario' => $usuario]);
    }

    public function actualizar(Request $request){
        $usuario = User::findOrFail(Auth::user()->id);
        $usuario->telefono = $request->telefono;
        $usuario->nombre = $request->nombre;
        $usuario->apellido = $request->apellido;
        $usuario->direccion = $request->direccion;
        $usuario->email = $request->email;

        if (Input::hasFile('foto')) {
            $file = Input::file('foto');
            $file->move(public_path() . '/img/' . $usuario->codigo . '/', $file->getClientOriginalName());
            $usuario->foto = $file->getClientOriginalName();
        }

        if(trim($request->password) != ""){
            $usuario->password = bcrypt($request->password);
        }

        $usuario -> save();

        return redirect('/usuario/editar');

    }
}
