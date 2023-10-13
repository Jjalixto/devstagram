<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class ImagenController extends Controller
{
    public function store(Request $request)
    {
        $imagen = $request->file("file");

        $nombreImagen = Str::uuid() . "." . $imagen->extension();
        //uuid =  genera un id unico para cada imagen

        $imagenServidor = Image::make($imagen);
        //esta clase image nos permite crear una imagen con intervenion image
        $imagenServidor->fit(1000,1000);
        //edita la imagen y hace un recorte
        $imagenPath = public_path('uploads') . '/' . $nombreImagen;
        $imagenServidor->save($imagenPath);

        return response()->json(["imagen" => $nombreImagen]);
    }
}
