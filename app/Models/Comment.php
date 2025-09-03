<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Auth;

class Comment extends Model
{
    use HasFactory;
    protected $fillable = ['content', 'post_id', 'user_id'];

    protected static function booted()
    {
        static::creating(function ($comment) {
            if (Auth::check()) {
                $comment->user_id = Auth::id();
            }
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function post()
    {
        return $this->belongsTo(Post::class);
    }
}
