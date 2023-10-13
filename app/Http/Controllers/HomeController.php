<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    public function __construct()
    {
        //si no esta autenticado se le redirigira a que inicie sesion
        $this->middleware('auth');
    }

    public function __invoke()
    {
        //obtener a quienes seguimos
        //pluck me filtra y toArray lo convierte en array
        $ids = auth()->user()->followings->pluck('id')->toArray();
        //metodo de latest ordena los post desde la ultima que se agrego
        $posts = Post::whereIn('user_id',$ids)->latest()->paginate(20);

        // dd($posts);
        //where filtra un valor, revisa un valor
        //wherein verifica los valores de un arreglo
        return view('home',[
            'posts' => $posts
        ]);
    }
}
