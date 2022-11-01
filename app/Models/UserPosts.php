<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserPosts extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    protected $casts = [
        'details' => 'json',
        'photo' => 'json',

    ];
    

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function comments(){
        return $this->hasMany(UserPostComment::class, 'post_id', 'id');
    }

    public function comments_custom(){
        return $this->hasOne(UserPostComment::class, 'post_id', 'id');
    }
    
}
