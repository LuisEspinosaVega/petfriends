<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Adoption extends Model
{
    use HasFactory;

    protected $fillable = [
        'profile_id',
        'user_id',
        'name',
        'type',
        'description',
        'status',
        'weight',
        'height',
        'image',
        'reazon',
        'accept',
        'vaccines',
        'sterilized'
    ];

    //El usuario que creo la publicacion
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    //El usuario que lo adopto
    public function adopter()
    {
        return $this->hasOne(Profile::class);
    }

    //Cuantas solicitudes tiene esta publicacion de adopcion
    public function arequest(){
        return $this->hasMany(Arequest::class);
    }
}
