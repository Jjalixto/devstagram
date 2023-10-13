<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    //
    public function index()
    {
        return view('auth.register');
    }

    public function store(Request $request)
    {
        // dd($request);
        // dd($request -> get("username")); //debugear y ver los valores qhe se este pasando

        //modificar el request
        $request -> request-> add(["username" => Str::slug($request -> username)]);

        //validacion de register
        $this->validate($request, [
            'name' =>'required|max:30',
            'username' => 'required|unique:users|min:3|max:20',
            'email' => 'required|unique:users|email|max:60',
            'password' => 'required|confirmed|min:6',
        ]);

        // dd('Creando usuario');

        User::create([
            "name" => $request->name,
            //slug elimina el acento y espacios
            "username" => $request->username,
            "email" => $request->email,
            //por defecto esta hasheado
            "password" => Hash::make($request->password)
        ]);

        //Autenticar un usuario
        // auth()->attempt([
        //     "email" => $request->email,
        //     "password" => $request -> password,
        // ]);

        //otra forma de autenticar
        auth()->attempt($request->only("email", "password"));

        //redireccionar
        return redirect()->route("posts.index",auth()->user()->username);
    }
}
