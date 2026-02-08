<?php

namespace App\Http\Controllers;

use App\Models\Staff;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class StaffController extends Controller
{
    public function index()
    {
        $staffs = Staff::orderBy('order')->get();
        return view('pages.management.staff.index', compact('staffs'));
    }

    public function create()
    {
        return view('pages.management.staff.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('staff', 'public');
        }

        Staff::create([
            'name' => $request->name,
            'position' => $request->position,
            'image' => $imagePath,
            'is_active' => true,
            'order' => Staff::count() + 1,
        ]);

        return redirect()->route('management.staff.index')->with('success', 'Aparatur berhasil ditambahkan.');
    }

    public function edit(Staff $staff)
    {
        return view('pages.management.staff.edit', compact('staff'));
    }

    public function update(Request $request, Staff $staff)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = [
            'name' => $request->name,
            'position' => $request->position,
        ];

        if ($request->hasFile('image')) {
            if ($staff->image) {
                Storage::disk('public')->delete($staff->image);
            }
            $data['image'] = $request->file('image')->store('staff', 'public');
        }

        $staff->update($data);

        return redirect()->route('management.staff.index')->with('success', 'Aparatur berhasil diperbarui.');
    }

    public function destroy(Staff $staff)
    {
        if ($staff->image) {
            Storage::disk('public')->delete($staff->image);
        }
        $staff->delete();
        return redirect()->route('management.staff.index')->with('success', 'Aparatur berhasil dihapus.');
    }
}