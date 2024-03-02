<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class OwnerDetail extends Model {
    protected $fillable = [
        'name',
        'email',
        'phone',
        'address',
        'img_url',
        'user_id',
    ];

    public function user() {
        return $this->belongsTo( User::class );
    }
}