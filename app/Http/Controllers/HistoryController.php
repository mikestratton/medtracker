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
        $events = Event::where('user_id', $user_id)
            ->orderBy('date', 'desc')
            ->get();

        return view('history.index', compact('events'));
    }
}
