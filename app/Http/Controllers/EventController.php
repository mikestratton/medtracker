<?php

namespace App\Http\Controllers;

use App\Services\TimezoneService; // Import the service
use App\Models\Event;
use App\Http\Requests\StoreEventRequest;
use App\Http\Requests\UpdateEventRequest;
use App\Models\MedicationAdministration;
use App\Http\Controllers\MedicationAdministrationController;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller
{

    protected $timezoneService;

    public function __construct(TimezoneService $timezoneService)
    {
        $this->timezoneService = $timezoneService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user_id = (int) Auth::id();
        $meds = MedicationAdministration::where('user_id', $user_id)->first();

        // Use user timezone functions
        $today = $this->timezoneService->getTodayInUserTimezone();
        $tomorrow = $this->timezoneService->getTomorrowInUserTimezone();

        $events = Event::where('user_id', $user_id)
            ->where('date', '>=', $today)
            ->where('date', '<', $tomorrow)
            ->get();

        $rowExists = MedicationAdministration::where('user_id', $user_id)->first();

        if ($rowExists) {
            $timesTaken = $rowExists->times_taken_daily;
        } else {
            $timesTaken = 0;
        }

        return view('events.index', compact('meds', 'timesTaken', 'events'));
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

        if ($request->form_id === 'history_form') {
            $event->update($request->all());
            return redirect()->route('history.index');
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
