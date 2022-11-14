<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Conversation extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'read'
    ];

    public function user1()
    {
        return $this->belongsTo(User::class, 'user_id_1', 'id');
    }

    public function user2()
    {
        return $this->belongsTo(User::class, 'user_id_2', 'id');
    }

    public function messages()
    {
        return $this->hasMany(Message::class);
    }
}
