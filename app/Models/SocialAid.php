<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SocialAid extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function recipients()
    {
        return $this->hasMany(SocialAidRecipient::class);
    }
}