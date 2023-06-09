<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Survey extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    protected $casts = [
        'setup' => 'json'
    ];

    public function questions()
    {
        return $this->hasMany(Question::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function records()
    {
        return $this->belongsTo(Record::class, 'id', 'survey_id');
    }

    public function survey_records()
    {
        return $this->hasMany(Record::class);
    }

}
