<?php

namespace App\Http\Controllers;

use App\Models\Letter;
use App\Models\Resident;
use App\Models\LetterRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;

class LetterController extends Controller
{
    // ... existing index, create, store methods ...

    // Method untuk menampilkan daftar permohonan warga (Admin)
    public function requests()
    {
        $requests = LetterRequest::with('resident')->latest()->paginate(10);
        return view('pages.letter.requests', compact('requests'));
    }

    // Method untuk update status permohonan (Admin)
    public function updateStatus(Request $request, $id)
    {
        $validated = $request->validate([
            'status' => 'required|in:pending,processing,ready,rejected,done',
            'admin_notes' => 'nullable|string',
        ]);

        $letterRequest = LetterRequest::findOrFail($id);
        $letterRequest->update($validated);

        return redirect()->back()->with('success', 'Status permohonan berhasil diperbarui.');
    }

    public function index()
    {
        $letters = Letter::with(['resident', 'user'])->latest()->paginate(10);
        return view('pages.letter.index', compact('letters'));
    }
    
    // ... existing other methods ...

    public function create()
    {
        // Fetch active residents only
        $residents = Resident::where('status', 'active')->orderBy('name')->get();
        return view('pages.letter.create', compact('residents'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'resident_id' => 'required|exists:residents,id',
            'letter_type' => 'required|in:SK_DOMISILI,SK_TM,SK_KELAHIRAN',
            'letter_number' => 'required|string|max:50',
            'remarks' => 'required|string|max:255',
        ]);

        $letter = Letter::create([
            'resident_id' => $validated['resident_id'],
            'user_id' => Auth::id(),
            'letter_type' => $validated['letter_type'],
            'letter_number' => $validated['letter_number'],
            'remarks' => $validated['remarks'],
        ]);

        return redirect()->route('letters.show', $letter->id);
    }

    public function show($id)
    {
        $letter = Letter::with('resident')->findOrFail($id);
        $is_pdf = false;

        if ($letter->letter_type == 'SK_DOMISILI') {
            return view('pages.letter.print_domisili', compact('letter', 'is_pdf'));
        } elseif ($letter->letter_type == 'SK_TM') {
            return view('pages.letter.print_sktm', compact('letter', 'is_pdf'));
        } elseif ($letter->letter_type == 'SK_KELAHIRAN') {
            return view('pages.letter.print_kelahiran', compact('letter', 'is_pdf'));
        }

        return abort(404);
    }

    public function download($id)
    {
        $letter = Letter::with('resident')->findOrFail($id);
        $is_pdf = true;
        
        if ($letter->letter_type == 'SK_DOMISILI') {
            $pdf = Pdf::loadView('pages.letter.print_domisili', compact('letter', 'is_pdf'));
            $pdf->setPaper('a4', 'portrait');
            return $pdf->download('Surat_Keterangan_Domisili_' . $letter->resident->nik . '.pdf');
        } elseif ($letter->letter_type == 'SK_TM') {
            $pdf = Pdf::loadView('pages.letter.print_sktm', compact('letter', 'is_pdf'));
            $pdf->setPaper('a4', 'portrait');
            return $pdf->download('Surat_Keterangan_Tidak_Mampu_' . $letter->resident->nik . '.pdf');
        } elseif ($letter->letter_type == 'SK_KELAHIRAN') {
            $pdf = Pdf::loadView('pages.letter.print_kelahiran', compact('letter', 'is_pdf'));
            $pdf->setPaper('a4', 'portrait');
            return $pdf->download('Surat_Keterangan_Kelahiran_' . $letter->resident->nik . '.pdf');
        }

        return abort(404);
    }
}