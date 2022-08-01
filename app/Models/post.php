<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Builder;

class Post extends Model
{
    use HasFactory, SoftDeletes;


    protected $fillable = [
        'content'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class, 'user_id');
    }

    public function media()
    {
        return $this->hasOne(Media::class, 'media_id');
    }


    public static function mostLiked(Builder $query){
        return $query= Post::withCount('likes')->orderBy('likes_count','desc')->take(10)->get();
    }

}