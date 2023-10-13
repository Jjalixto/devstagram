<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class PostController extends Controller
{
    public function __construct()
    {
        //se protege la ruta con el middleware
        $this->middleware("auth")->except(['show','index']);
        //con el except se ristringe a usuarios para que puedan acceder a aquellas paginas señaladas
    }

    public function index(User $user)
    {
        //se esta llamando al modelo post y con get se trae los resultados
        $posts = Post::where('user_id', $user->id)->latest()->paginate(20);

        //simplePaginate

        // dd($posts);
        // dd($user->id);
        // dd(auth()->user());
        // dd($user->username);
        return view("dashboard", [
            "user" => $user,
            "posts" => $posts,
        ]);
    }

    public function create()
    {
        return view("posts.create");
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'titulo' => 'required|max:255',
            'descripcion' => 'required',
            'imagen' => 'required'
        ]);

        //se crea el post
        Post::create([
            'titulo' => $request->titulo,
            'descripcion' => $request->descripcion,
            'imagen' => $request->imagen,
            'user_id' => auth()->user()->id,
        ]);

        //otra forma de crear el post
        // $post = new Post();
        // $post->titulo = $request;
        // $post->descripcion = $request;
        // $post->imagen = $request;
        // $post->user_id = auth()->user()->id;
        // $post->save();

        //tercera forma de crear el post estilo de laravel utilizando laravel
        // $request -> user()->posts()->create([
        //     'titulo' => $request->titulo,
        //     'descripcion' => $request->descripcion,
        //     'imagen' => $request->imagen,
        //     'user_id' => auth()->user()->id,
        // ]);

        return redirect()->route('posts.index',auth()->user()->username);
    }

    public function show(User $user, Post $post)
    {
        return view('posts.show',[
            "post" => $post,
            "user" => $user
        ]);
    }

    public function destroy(Post $post)
    {
        // dd("eliminando",$post->id);
        // if($post->user_id === auth()->user()->id){
        //     dd("si es la misma persona");
        // }else{
        //     dd("no es la misma persona");
        // }
        $this->authorize('delete',$post);
        //con esto se protegue
        $post->delete();

        //eliminando imagen
        $imagen_path = public_path('uploads/' . $post->imagen);

        if(File::exists($imagen_path)){
            unlink($imagen_path);
            //funcion de php para eliminar
        }

        return redirect()->route('posts.index',auth()->user()->username);
    }
}
