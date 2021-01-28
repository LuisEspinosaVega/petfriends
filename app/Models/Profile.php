<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    protected $fillable = [
        'phone',
        'address',
        'sex',
        'description',
        'accept'
    ];

    //Regresar el usuario al que pertenece este perfil
    public function user(){
        return $this->belongsTo(User::class);
    }

    //Reegresar los usuarios que siguen este perfil
    public function followers(){
        return $this->belongsToMany(User::class);
    }

    //Mensajes recividos
    public function recivedMessages(){
        return $this->hasMany(Message::class)->distinct('user_id');
    }

    public function adopted(){
        return $this->hasMany(Adoption::class)->latest();
    }
}
