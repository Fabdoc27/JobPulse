<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WorkExperience extends Model
{
    protected $fillable = [
        'candidate_id',
        'job_title',
        'company',
        'start_date',
        'end_date',
    ];

    public function candidateDetail()
    {
        return $this->belongsTo(CandidateDetail::class, 'candidate_id');
    }
}
