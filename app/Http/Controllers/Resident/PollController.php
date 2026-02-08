<?php

namespace App\Http\Controllers\Resident;

use App\Http\Controllers\Controller;
use App\Models\Poll;
use App\Models\PollVote;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PollController extends Controller
{
    public function index()
    {
        $polls = Poll::with(['options'])
            ->where('is_active', true)
            ->where(function($query) {
                $query->whereNull('end_date')
                      ->orWhere('end_date', '>', now());
            })
            ->latest()
            ->get();
            
        $residentId = Auth::guard('resident')->id();
        
        return view('pages.warga.polls.index', compact('polls', 'residentId'));
    }

    public function vote(Request $request, Poll $poll)
    {
        $validated = $request->validate([
            'poll_option_id' => 'required|exists:poll_options,id',
        ]);

        $residentId = Auth::guard('resident')->id();

        if ($poll->hasVoted($residentId)) {
            return redirect()->back()->with('error', 'Anda sudah memberikan suara pada polling ini.');
        }

        PollVote::create([
            'poll_id' => $poll->id,
            'poll_option_id' => $validated['poll_option_id'],
            'resident_id' => $residentId,
        ]);

        return redirect()->back()->with('success', 'Suara Anda berhasil dikirim.');
    }
}
