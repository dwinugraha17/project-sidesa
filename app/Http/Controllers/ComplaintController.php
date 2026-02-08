<?php

namespace App\Http\Controllers;

use App\Models\Complaint;
use Illuminate\Http\Request;

class ComplaintController extends Controller
{
    public function index()
    {
        $complaints = Complaint::with('resident')->latest()->paginate(10);
        return view('pages.management.complaint.index', compact('complaints'));
    }

    public function show(Complaint $complaint)
    {
        return view('pages.management.complaint.show', compact('complaint'));
    }

    public function update(Request $request, Complaint $complaint)
    {
        $validated = $request->validate([
            'status' => 'required|in:pending,processing,completed,rejected',
            'admin_note' => 'nullable|string',
        ]);

        $complaint->update($validated);

        return redirect()->route('management.complaints.index')->with('success', 'Status laporan berhasil diperbarui.');
    }

    public function destroy(Complaint $complaint)
    {
        $complaint->delete();
        return redirect()->route('management.complaints.index')->with('success', 'Laporan berhasil dihapus.');
    }
}
