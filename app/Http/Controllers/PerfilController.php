<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class PerfilController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        // dd("aqui se muestra");
        return view('perfil.index');
    }

    public function store(Request $request)
    {
        // dd("guardando datos");
        $request->request->add(['username' => Str::slug($request->username)]);

        $this->validate($request,[
            //cuando pasas mas de 3 reglas es recomendable que sea por arreglo
            //el not_in funciona como una lista negra y el in funciona al reves hace que eliga entre 1 o varias palabras ....reglas de validacion
            'username' => ['required','unique:users,username,' . auth()->user()->id,'min:3','max:20','not_in:twitter,editar-perfil'],
            // 'username' => 'required|unique:users|min:3|max:20',
        ]);

        if($request->imagen){

            $imagen = $request->file("imagen");

            $nombreImagen = Str::uuid() . "." . $imagen->extension();
            //uuid =  genera un id unico para cada imagen

            $imagenServidor = Image::make($imagen);
            //esta clase image nos permite crear una imagen con intervenion image
            $imagenServidor->fit(1000,1000);
            //edita la imagen y hace un recorte
            $imagenPath = public_path('perfiles') . '/' . $nombreImagen;
            $imagenServidor->save($imagenPath);
        }
           //guardar cambios
            $usuario = User::find(auth()->user()->id);
            $usuario->username = $request->username;
            $usuario->imagen = $nombreImagen ?? auth()->user()->imagen ??'';
            $usuario->save();

            //redireccionar al usuario
            return redirect()->route("posts.index",$usuario->username);

    }
}
