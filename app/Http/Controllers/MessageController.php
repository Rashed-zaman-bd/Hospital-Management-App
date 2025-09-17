<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    public function index(){
        $messages = Message::latest()->get();
        return view('backend.pages.message.message_show', compact('messages'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'subject' => 'required',
            'message' => 'required'

        ]);

        Message::create([
            'user-id' => Auth::id(),
            'name' => $request->name,
            'email' => $request->email,
            'subject' => $request->subject,
            'message' => $request->message
        ]);

        sweetalert()->success('Your message send successfully.');
        return back();
    }

      public function show(string $id)
    {
         $message = Message::findOrFail($id); // fetch message by ID
            return view('backend.pages.message.message_read', compact('message'));
    }

    public function destroy(string $id)
    {
        Message::findOrFail($id)->delete();
        toastr()->success('Delete successfully');
        return redirect()->back();
    }
}
