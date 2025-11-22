<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $fillable = [
        'name',
    ];

    // A tag belongs to many jobs
    public function jobs()
    {
        return $this->belongsToMany(Job::class);
    }
}
