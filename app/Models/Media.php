<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    use HasFactory;


    protected $fillable = [
        'filename',
        'url',
    ];


    public function post()
    {
        $this->belongsTo(Post::class, 'post_id');
    }
}
