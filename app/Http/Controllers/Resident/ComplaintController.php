<?php

namespace App\Http\Controllers\Resident;

use App\Http\Controllers\Controller;
use App\Models\Complaint;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ComplaintController extends Controller
{
    public function index()
    {
        $complaints = Complaint::where('resident_id', Auth::guard('resident')->id())
            ->latest()
            ->get();
        return view('pages.warga.complaints.index', compact('complaints'));
    }

    public function create()
    {
        return view('pages.warga.complaints.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'latitude' => 'nullable|string',
            'longitude' => 'nullable|string',
        ]);

        if ($request->hasFile('photo')) {
            $validated['photo'] = $request->file('photo')->store('complaints', 'public');
        }

        $validated['resident_id'] = Auth::guard('resident')->id();
        $validated['status'] = 'pending';

        Complaint::create($validated);

        return redirect()->route('resident.complaints.index')->with('success', 'Laporan berhasil dikirim.');
    }

    public function show(Complaint $complaint)
    {
        if ($complaint->resident_id !== Auth::guard('resident')->id()) {
            abort(403);
        }
        return view('pages.warga.complaints.show', compact('complaint'));
    }
}
