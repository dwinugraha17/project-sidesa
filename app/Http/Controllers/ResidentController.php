<?php

namespace App\Http\Controllers;

use App\Models\Resident; // pastikan ini di bagian atas
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ResidentController extends Controller
{

    public function index(Request $request)
    {
        $search = $request->input('search');
        
        $residents = Resident::query()
            ->when($search, function($query, $search) {
                return $query->where('name', 'like', "%{$search}%")
                             ->orWhere('nik', 'like', "%{$search}%");
            })
            ->latest()
            ->paginate(10);

        return view('pages.resident.index', compact('residents'));
    }


    public function create()
    {
        return view('pages.resident.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nik' => ['required', 'min:16', 'max:16', 'unique:residents,nik'],
            'name' => ['required', 'max:100'],
            'gender' => ['required', Rule::in(['male', 'female'])],
            'birth_date' => ['required', 'string'],
            'birth_place' => ['required', 'max:100'],
            'address' => ['required', 'max:700'],
            'religion' => ['nullable', 'max:50'],
            'marital_status' => ['required', Rule::in(['single', 'married', 'divorced', 'widowed'])],
            'occupation' => ['nullable', 'max:100'],
            'phone' => ['nullable', 'max:15'],
            'dusun' => ['required', 'string'],
            'status' => ['required', Rule::in(['active', 'moved', 'deceased'])],
        ]);

        Resident::create($validated);

        return redirect('/resident')->with('success', 'Data berhasil ditambahkan');
    }

    public function edit($id)
    {
        $resident = Resident::findOrFail($id);

        return view('pages.resident.create', [
            'resident' => $resident,
        ]);
    }

    public function update(Request $request, $id)
    {
        $resident = Resident::findOrFail($id);

        $validated = $request->validate([
            'nik' => ['required', 'min:16', 'max:16', Rule::unique('residents', 'nik')->ignore($resident->id)],
            'name' => ['required', 'max:100'],
            'gender' => ['required', Rule::in(['male', 'female'])],
            'birth_date' => ['required', 'string'],
            'birth_place' => ['required', 'max:100'],
            'address' => ['required', 'max:700'],
            'religion' => ['nullable', 'max:50'],
            'marital_status' => ['required', Rule::in(['single', 'married', 'divorced', 'widowed'])],
            'occupation' => ['nullable', 'max:100'],
            'phone' => ['nullable', 'max:15'],
            'dusun' => ['required', 'string'],
            'status' => ['required', Rule::in(['active', 'moved', 'deceased'])],
        ]);

        $resident->update($validated);

        return redirect('/resident')->with('success', 'Data berhasil diubah');
    }

    public function destroy($id)
    {
        $resident = Resident::findOrFail($id);
        $resident->delete();

        return redirect('/resident')->with('success', 'Data berhasil dihapus');
    }
}
