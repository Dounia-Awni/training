<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class comment extends Model
{
    use HasFactory, SoftDeletes;


    public function user()
    {
        $this->belongsTo(User::class, 'id');
    }

    public function post()
    {
        $this->belongsTo(Post::class, 'user_id');
    }
}
