<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreLoginRequest;
use Illuminate\Support\Facades\Auth;

class loginController extends Controller
{
    public function index(){
        if(Auth::check()){
            return redirect()->route('home');
        }

        return view('auth.login');
    }

    public function login(StoreLoginRequest $request){

        // Validar credenciales
        if(!Auth::validate($request->only('email', 'password'))){
            return redirect()->to('login')->withErrors('Credenciales incorrectas');
        }

        //Crear una sesión
        $user = Auth::getProvider()->retrieveByCredentials($request->only('email', 'password'));
        Auth::login($user);

        return redirect()->route('home')->with('success', 'Bienvenido ' .$user->name);
    }


}
