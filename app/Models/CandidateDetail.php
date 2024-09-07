<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CandidateDetail extends Model
{
    protected $fillable = [
        'name',
        'email',
        'phone',
        'address',
        'img_url',
        'skills',
        'current_salary',
        'expected_salary',
        'user_id',
    ];

    protected $casts = [
        'skills' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function educationHistories()
    {
        return $this->hasMany(EducationHistory::class, 'candidate_id');
    }

    public function workExperiences()
    {
        return $this->hasMany(WorkExperience::class, 'candidate_id');
    }

    public function jobs()
    {
        return $this->belongsToMany(Job::class, 'job_candidates', 'candidate_id', 'job_id')->withPivot('status')->withTimestamps();
    }
}
