<?php

namespace App\Http\Controllers;

use App\Models\ContactMessage;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class ContactController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        ContactMessage::create($validated);

        Alert::success('Success', 'Your message has been sent successfully! We will get back to you soon.');
        return redirect()->back();
    }

    public function index()
    {
        $messages = ContactMessage::orderBy('created_at', 'desc')->get();
        return view('pages.admin.contact.list', ['messages' => $messages]);
    }

    public function markAsRead($id)
    {
        $message = ContactMessage::findOrFail($id);
        $message->update(['status' => 'read']);
        
        Alert::success('Success', 'Message marked as read');
        return redirect()->back();
    }

    public function markAsReplied($id)
    {
        $message = ContactMessage::findOrFail($id);
        $message->update(['status' => 'replied']);
        
        Alert::success('Success', 'Message marked as replied');
        return redirect()->back();
    }

    public function delete($id)
    {
        ContactMessage::findOrFail($id)->delete();
        
        Alert::success('Success', 'Message deleted successfully');
        return redirect()->back();
    }
}