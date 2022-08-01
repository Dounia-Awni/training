<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'content'
    ];


    public function user()
    {
        $this->belongsTo(User::class, 'id');
    }

    public function post()
    {
        $this->belongsTo(Post::class, 'user_id');
    }
}
