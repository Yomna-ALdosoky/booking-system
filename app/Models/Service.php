<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected $fillable= [ 
        'user_id',
        'name',
        'description',
        'price',
    ];

    public function booking() {
        return $this->hasMany(Booking::class);
    }

    public function provider(){
        return $this->belongsTo(User::class, 'user_id');
    }
}
