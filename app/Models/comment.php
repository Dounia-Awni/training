<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class comment extends Model
{
    use HasFactory;
   

    public function user()
    {
        $this->belongsTo('App\User');
    }

    public function post()
    {
        $this->belongsTo('App\Post');
    }
}
