<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    protected $fillable = [
        'company_id',
        'title',
        'category',
        'description',
        'location',
        'skills',
        'salary',
        'status',
        'applied',
        'deadline',
    ];

    protected $casts = [
        'skills' => 'array',
    ];

    public function company()
    {
        return $this->belongsTo(CompanyDetail::class, 'company_id');
    }

    public function candidates()
    {
        return $this->belongsToMany(CandidateDetail::class, 'job_candidates', 'job_id', 'candidate_id')->withPivot('status')->withTimestamps();
    }

    public function appliedCount()
    {
        return $this->candidates()->count();
    }
}
