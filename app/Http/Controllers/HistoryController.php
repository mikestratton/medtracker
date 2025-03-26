<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HistoryController extends Controller
{
    public function index()
    {
        $user_id = (int) Auth::id();
        $events = Event::where('user_id', $user_id)->get();

        return view('history.index', compact('events'));
    }

    public function update(Request $request, Event $event)
    {
        $user_id = Auth::id();
//        dd($request->all());
        if ((int) $request->user_id !== $user_id) {
            return 'wrong user id';
            abort(403);
        }

        $validatedData = $request->validate([
            'user_id' => 'integer',
            'has_taken_medication' => 'integer',
            'note' => 'string',
            'date' => 'date',
            'time' => 'string',
        ]);

        dd($validatedData);

        $event->update($validatedData);

//        $event->update($request->all());

        return redirect()->route('history.index');
    }
}
