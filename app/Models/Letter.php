<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Letter extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function resident()
    {
        return $this->belongsTo(Resident::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}