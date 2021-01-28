<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'username',
        'image'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    //Crear el perfil del usuario al momento de crear al usuario
    protected static function boot()
    {
        parent::boot();

        static::created(function ($user) {
            $user->profile()->create();
        });
    }

    //Funcion para retornar los perfiles que sigue el usuario
    public function following(){
        return $this->belongsToMany(Profile::class);
    }

    //Relacion con post, un usuario puede tener varios
    public function posts()
    {
        return $this->hasMany(Post::class)->orderBy('created_at', 'DESC');
    }

    //Relacion con el perfil, un usuario puede tener un perfil
    public function profile()
    {
        return $this->hasOne(Profile::class);
    }

    //Los mensajes que ha enviado este usuario
    public function sentMessages(){
        return $this->hasMany(Message::class);
    }

    //Ventas que ha hecho este usuario
    public function sales(){
        return $this->hasMany(Sale::class)->orderBy('created_at', 'desc');
    }

    // todas las publicaciones de adopcion que ha hecho el usuario
    public function adoptions(){
        return $this->hasMany(Adoption::class)->orderBy('created_at', 'desc');
    }

    //Todas las solicitudes de adopcion que ha hecho el usuario
    public function arequests(){
        return $this->hasMany(Arequest::class)->orderBy('created_at', 'desc');
    }
}
