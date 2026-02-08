<?php

namespace App\Http\Controllers;

use App\Models\Poll;
use App\Models\PollOption;
use Illuminate\Http\Request;

class PollController extends Controller
{
    public function index()
    {
        $polls = Poll::withCount('votes')->latest()->paginate(10);
        return view('pages.management.poll.index', compact('polls'));
    }

    public function create()
    {
        return view('pages.management.poll.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'end_date' => 'nullable|date',
            'options' => 'required|array|min:2',
            'options.*' => 'required|string|max:255',
        ]);

        $poll = Poll::create([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'end_date' => $validated['end_date'],
            'is_active' => true,
        ]);

        foreach ($validated['options'] as $optionText) {
            PollOption::create([
                'poll_id' => $poll->id,
                'option_text' => $optionText,
            ]);
        }

        return redirect()->route('management.polls.index')->with('success', 'Polling berhasil dibuat.');
    }

    public function show(Poll $poll)
    {
        $poll->load(['options' => function($query) {
            $query->withCount('votes');
        }]);
        return view('pages.management.poll.show', compact('poll'));
    }

    public function toggleStatus(Poll $poll)
    {
        $poll->update(['is_active' => !$poll->is_active]);
        return redirect()->back()->with('success', 'Status polling berhasil diubah.');
    }

    public function destroy(Poll $poll)
    {
        $poll->delete();
        return redirect()->route('management.polls.index')->with('success', 'Polling berhasil dihapus.');
    }
}
