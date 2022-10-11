<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Course extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    public function college()
    {
        return $this->belongsTo(College::class);
    }

    public function graduates()
    {
        return $this->hasMany(Graduate::class);
    }
}
