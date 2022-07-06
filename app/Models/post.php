<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class post extends Model
{
    use HasFactory, SoftDeletes;


    

    public function user()
    {
        return $this->belongsTo(User::class,'id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class, 'user_id');
    }
}
