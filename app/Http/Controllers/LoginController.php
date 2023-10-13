<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    //
    public function index()
    {
        return view("auth.login");
    }

    public function store(Request $request)
    {
        // dd("autenticando");
        $this->validate($request,[
            'email' => 'required|email',
            'password' => 'required',
        ]);

        //en el caso en que el usuario no pueda autenticarse
        if(!auth()->attempt($request->only("email","password"),$request->remember)){
            return back()->with("mensaje","credenciales incorrectas");
            //es vuelve a donde enviaste esta info con back() pero va con un mensaje de error with()
        }
        //si se loguea correctamente le va redireccionar a otra pagina
        return redirect()->route("posts.index",auth()->user()->username);
    }
}
