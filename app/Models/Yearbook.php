<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Yearbook extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    public function graduates()
    {
        return $this->hasMany(Graduate::class);
    }
}
