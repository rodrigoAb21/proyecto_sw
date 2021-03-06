<?php

namespace App\Http\Controllers\Auth;

use App\Cuenta;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'nombre' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $cuenta = new Cuenta();
        $cuenta -> nro = $data['codigo'];
        $cuenta -> saldo = 0;
        $cuenta -> save();


        if (Input::hasFile('foto')) {
            $file = Input::file('foto');
            $file -> move(public_path().'/img/'.$data['codigo'].'/', $file->getClientOriginalName());

            return User::create([
                'carnet' => $data['carnet'],
                'codigo' => $data['codigo'],
                'nombre' => $data['nombre'],
                'apellido' => $data['apellido'],
                'foto' => $file -> getClientOriginalName(),
                'telefono' => $data['telefono'],
                'direccion' => $data['direccion'],
                'tipo' => $data['tipo'],
                'email' => $data['email'],
                'password' => bcrypt($data['password']),
                'cuenta_id' => $cuenta -> id,
            ]);
        }else{
            return null;
        }

    }
}
