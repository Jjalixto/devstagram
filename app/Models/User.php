<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Like;
use App\Models\Post;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        //user name se agrego por que se habia agregado el post
        'username'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    //primero se crea el metodo
    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    //metodo que almacene los seguidores de un usuario
    public function followers()
    {
        //el usuario va tener el metodo de followers y va insertar en la tabla de followers lo siguiente
        return $this->belongsToMany(User::class,'followers','user_id','follower_id');
    }

    //almacenar a las personas que seguimos
    public function followings()
    {
        //el usuario va tener el metodo de followers y va insertar en la tabla de followers lo siguiente
        return $this->belongsToMany(User::class,'followers','follower_id','user_id');
    }

    //comprobar si un usuario sigue a un usuario
    public function siguiendo(User $user)
    {
        //el contains sirve para iterar en toda la tabla y ver si la persona es un seguidor
        return $this->followers->contains($user->id);
    }
}
