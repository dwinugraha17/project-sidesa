<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Complaint extends Model
{
    use HasFactory;

    protected $fillable = [
        'resident_id',
        'title',
        'description',
        'photo',
        'latitude',
        'longitude',
        'status',
        'admin_note',
    ];

    public function resident()
    {
        return $this->belongsTo(Resident::class);
    }
}
