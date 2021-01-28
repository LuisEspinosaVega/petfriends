<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Arequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'adoption_id',
        'user_id',
        'age',
        'members',
        'agree',
        'more',
        'many',
        'space',
        'data',
        'why',
        'accept'
    ];

    public function adoption(){
        return $this->belongsTo(Adoption::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
