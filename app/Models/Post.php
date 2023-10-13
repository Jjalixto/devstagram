<?php

namespace App\Models;

use App\Models\Like;
use App\Models\Comentario;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        //esto es para que laravel sepa que informacion tiene que leer y enviar a la base de datos
        //siempre sera la misma que se tenga en el controlador
        'titulo',
        'descripcion',
        'imagen',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class)->select(['name','username']);
        //cuando se hacen consultas con tinker y no quieres que traiga toda la informacion se hace un select y le das
        //los parametros u datos que solo quieres que pinte
    }

    public function comentarios()
    {
        return $this->hasMany(Comentario::class);
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    public function checkLike(User $user)
    {
        return $this->likes->contains('user_id',$user->id);
    }
}
