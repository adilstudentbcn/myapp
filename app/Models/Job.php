<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    protected $fillable = [
        'employer_id',
        'title',
        'location',
        'salary',
        'apply_url',
        'featured',
        'description', // optional later
    ];

    public function employer()
    {
        return $this->belongsTo(Employer::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function applications()
    {
        return $this->hasMany(JobApplication::class);
    }

}
