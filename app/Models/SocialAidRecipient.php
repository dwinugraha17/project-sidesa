<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SocialAidRecipient extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function socialAid()
    {
        return $this->belongsTo(SocialAid::class);
    }

    public function resident()
    {
        return $this->belongsTo(Resident::class);
    }
}