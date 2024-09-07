<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    protected $fillable = [
        'title',
        'img_url',
        'description',
        'tags',
    ];

    protected $casts = [
        'tags' => 'array',
    ];
}
