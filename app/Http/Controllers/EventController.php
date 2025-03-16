<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Http\Requests\StoreEventRequest;
use App\Http\Requests\UpdateEventRequest;
use App\Models\MedicationAdministration;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user_id = (int) Auth::id();
        $meds = MedicationAdministration::where('user_id', $user_id)->first(); // user_id is the foreign key column.

        $today = Carbon::today()->toDateTimeString();
        $tomorrow = Carbon::tomorrow()->toDateTimeString();

        $events = Event::where('user_id', $user_id)
            ->where('date', '>=', $today)
            ->where('date', '<', $tomorrow)
            ->get();

        $rowExists = MedicationAdministration::where('user_id', $user_id)->first(); // user_id is the foreign key column.

        if ($rowExists) {
            $timesTaken = $rowExists->times_taken_daily;
        } else {
            $timesTaken = 0;
        }

        return view('events.index', compact( 'meds',  'timesTaken', 'events'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

    }

    /**
     * Display the specified resource.
     */
    public function show(Event $event)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Event $event)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Event $event)
    {
        if ($event->user_id !== Auth::id()) {
            abort(403);
        }

        $event->update($request->all());

        return redirect()->route('events.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Event $event)
    {
        //
    }
}
