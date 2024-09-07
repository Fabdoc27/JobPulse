<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Plugin extends Model
{
    protected $fillable = [
        'name',
        'features',
    ];

    public function companies()
    {
        return $this->belongsToMany(CompanyDetail::class, 'company_plugins', 'plugin_id', 'company_id')->withPivot('status')->withTimestamps();
    }
}
