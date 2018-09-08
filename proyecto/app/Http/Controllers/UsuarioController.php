<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UsuarioController extends Controller
{
    public function editar(){
        return view('usuarios.edit');
    }

    public function actualizar(Request $request){
        $usuario = User::findOrFail(Auth::user()->id);
        $usuario->telefono = $request->telefono;
        $usuario->nombre = $request->nombre;
        $usuario->apellido = $request->apellido;
        $usuario->direccion = $request->direccion;
        $usuario->email = $request->email;
        if(trim($request->password) != ""){
            $usuario->password = bcrypt($request->password);
        }
        $usuario -> update();

        return redirect('/usuario/editar');

    }
}
