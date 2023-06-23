<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Message;
use App\Models\Conversation;


class MessageController extends Controller
{

    public function show()
    {
        $users = User::where('id', '!=', auth()->id())->get();
        return view('send', compact('users'));
    }

    public function index()
    {

        $user = auth()->user();
        $conversations = Conversation::join('messages', 'messages.conversation_id', '=', 'conversations.id')
            ->where(function ($query) {
                $query->where('messages.user_id', auth()->id())
                    ->orWhere('messages.recipient_id', auth()->id());
            })
            ->select('conversations.id', 'conversations.created_at', 'conversations.updated_at')
            ->distinct()
            ->orderBy('conversations.updated_at', 'desc')
            ->get();
        return view('messages', compact('conversations'));
    }




    public function store(Request $request)
    {
        $this->validate($request, [
            'recipient_id' => 'required|exists:users,id',
            'message' => 'required|string|max:1000'
        ]);
        return redirect()->back()->with('success', 'Message sent successfully!');
    }


    public function create(Request $request)
    {
        $this->validate($request, [
            'recipient_id' => 'required|exists:users,id',
            'message' => 'required|string|max:1000'
        ]);

        $sender = auth()->user();
        $recipient = User::find($request->input('recipient_id'));
        $message = $request->input('message');

        $conversation = Conversation::where(function ($query) use ($sender, $recipient) {
            $query->where('id', $sender->id)
                ->where('id', $recipient->id);
        })->orWhere(function ($query) use ($sender, $recipient) {
            $query->where('id', $recipient->id)
                ->where('id', $sender->id);
        })->first();

        if (!$conversation) {
            $conversation = Conversation::create([
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }

        $conversation->messages()->create([
            'user_id' => $sender->id,
            'recipient_id' => $recipient->id,
            'body' => $message
        ]);

        return redirect()->back()->with('success', 'Message sent successfully!');
    }
}
