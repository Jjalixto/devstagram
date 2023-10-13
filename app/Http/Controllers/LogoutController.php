<?php

namespace App\Http\Controllers;

class LogoutController extends Controller
{
    public function store()
    {
        // dd("cerrando sesion");
        auth()->logout();
        //cerrando sesion
        return redirect()->route("login");
    }
}
