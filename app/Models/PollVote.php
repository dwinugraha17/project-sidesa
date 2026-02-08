<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PollVote extends Model
{
    use HasFactory;

    protected $fillable = [
        'poll_id',
        'poll_option_id',
        'resident_id',
    ];

    public function poll()
    {
        return $this->belongsTo(Poll::class);
    }

    public function option()
    {
        return $this->belongsTo(PollOption::class, 'poll_option_id');
    }

    public function resident()
    {
        return $this->belongsTo(Resident::class);
    }
}
