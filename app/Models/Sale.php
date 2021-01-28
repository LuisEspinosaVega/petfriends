<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'amount',
        'price',
        'image',
        'user_id',
        'status',
        'category'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
