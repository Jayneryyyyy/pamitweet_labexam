<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tweet extends Model
{
    use HasFactory;

    protected $fillable = ['content'];

    // RELATIONSHIP 1: A tweet belongs to a User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // RELATIONSHIP 2: A tweet has many Likes
    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    // HELPER: Check if a specific user liked this tweet
    public function isLikedBy($user)
    {
        if (!$user) return false;
        return $this->likes->contains('user_id', $user->id);
    }
}