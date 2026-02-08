<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function index()
    {
        $messages = Message::latest()->paginate(10);
        return view('pages.management.message.index', compact('messages'));
    }

    public function show($id)
    {
        $message = Message::findOrFail($id);
        $message->update(['is_read' => true]);
        return view('pages.management.message.show', compact('message'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'contact' => 'required|string|max:255',
            'subject' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        Message::create($request->all());

        return redirect()->back()->with('success', 'Pesan Anda telah terkirim. Terima kasih atas aspirasinya!');
    }

    public function destroy($id)
    {
        $message = Message::findOrFail($id);
        $message->delete();
        return redirect()->route('management.messages.index')->with('success', 'Pesan berhasil dihapus.');
    }
}