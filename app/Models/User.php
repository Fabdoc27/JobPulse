<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable {
    use HasApiTokens, HasFactory, Notifiable;
    protected $fillable = [
        'email',
        'password',
        'role',
        'otp',
    ];

    public function ownerDetails() {
        return $this->hasOne( OwnerDetail::class );
    }

    public function companyDetails() {
        return $this->hasOne( CompanyDetail::class );
    }

    public function candidateDetails() {
        return $this->hasOne( CandidateDetail::class, 'user_id' );
    }

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password'          => 'hashed',
    ];
}