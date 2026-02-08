<?php

namespace App\Http\Controllers\Resident;

use App\Http\Controllers\Controller;
use App\Models\LetterRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $resident = Auth::guard('resident')->user();
        $requests = LetterRequest::where('resident_id', $resident->id)->latest()->get();
        return view('pages.warga.dashboard', compact('resident', 'requests'));
    }

    public function requestLetter(Request $request)
    {
        $validated = $request->validate([
            'letter_type' => 'required|string',
            'remarks' => 'required|string',
        ]);

        LetterRequest::create([
            'resident_id' => Auth::guard('resident')->id(),
            'letter_type' => $validated['letter_type'],
            'remarks' => $validated['remarks'],
            'status' => 'pending',
        ]);

        return redirect()->back()->with('success', 'Permohonan surat berhasil dikirim.');
    }
}