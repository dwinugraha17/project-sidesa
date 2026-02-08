<?php

namespace App\Http\Controllers;

use App\Models\SocialAid;
use App\Models\SocialAidRecipient;
use App\Models\Resident;
use Illuminate\Http\Request;

class SocialAidController extends Controller
{
    public function index()
    {
        $socialAids = SocialAid::withCount('recipients')->latest()->get();
        return view('pages.social_aid.index', compact('socialAids'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'amount' => 'required|numeric|min:0',
            'description' => 'nullable|string',
        ]);

        SocialAid::create($validated);

        return redirect()->back()->with('success', 'Jenis bantuan berhasil ditambahkan.');
    }

    public function show($id)
    {
        $socialAid = SocialAid::with(['recipients.resident'])->findOrFail($id);
        
        // Exclude residents who are already recipients for this aid
        $existingRecipientIds = $socialAid->recipients->pluck('resident_id');
        $residents = Resident::where('status', 'active')
            ->whereNotIn('id', $existingRecipientIds)
            ->orderBy('name')
            ->get();

        return view('pages.social_aid.show', compact('socialAid', 'residents'));
    }

    public function addRecipient(Request $request, $id)
    {
        $validated = $request->validate([
            'resident_id' => 'required|exists:residents,id',
            'status' => 'required|in:pending,received,rejected',
        ]);

        SocialAidRecipient::create([
            'social_aid_id' => $id,
            'resident_id' => $validated['resident_id'],
            'status' => $validated['status'],
            'received_at' => $validated['status'] == 'received' ? now() : null,
        ]);

        return redirect()->back()->with('success', 'Penerima berhasil ditambahkan.');
    }

    public function destroyRecipient($id)
    {
        $recipient = SocialAidRecipient::findOrFail($id);
        $recipient->delete();

        return redirect()->back()->with('success', 'Penerima berhasil dihapus.');
    }
}