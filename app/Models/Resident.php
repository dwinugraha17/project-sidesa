<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Resident extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'nik',
        'name',
        'gender',
        'birth_date',
        'birth_place',
        'address',
        'religion',
        'marital_status',
        'occupation',
        'phone',
        'status',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'password' => 'hashed',
    ];

    public function letterRequests()
    {
        return $this->hasMany(LetterRequest::class);
    }

    public function complaints()
    {
        return $this->hasMany(Complaint::class);
    }

    public function pollVotes()
    {
        return $this->hasMany(PollVote::class);
    }
}