<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class CompanyDetail extends Model {
    protected $fillable = [
        'name',
        'email',
        'phone',
        'address',
        'img_url',
        'status',
        'user_id',
    ];

    public function user() {
        return $this->belongsTo( User::class );
    }

    public function jobs() {
        return $this->hasMany( Job::class, 'company_id' );
    }

    public function plugins() {
        return $this->belongsToMany( Plugin::class, 'company_plugins', 'company_id', 'plugin_id' )->withPivot( 'status' )->withTimestamps();
    }
}