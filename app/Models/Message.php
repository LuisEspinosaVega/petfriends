<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $fillable = [
        'message_content',
        'user_id',
        'profile_id',
        'seen'
    ];

    public function profile(){
        return $this->belongsTo(Profile::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
