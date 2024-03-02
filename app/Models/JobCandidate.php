<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JobCandidate extends Model {
    protected $fillable = [
        'job_id',
        'candidate_id',
        'status',
    ];
}