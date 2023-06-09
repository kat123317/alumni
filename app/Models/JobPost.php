<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class JobPost extends Model
{
    use HasFactory,SoftDeletes;
    protected $guarded = [];

    protected $casts = [
        'details' => 'json',
        'photo' => 'json',

    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
