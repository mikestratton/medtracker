<?php

namespace App\Http\Controllers;

use App\Services\TimezoneService; // Import the service
use App\Models\MedicationAdministration;
use App\Models\Event;
use App\Http\Requests\StoreMedicationAdministrationRequest;
use App\Http\Requests\UpdateMedicationAdministrationRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class MedicationAdministrationController extends Controller
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
        //
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
    public function store(Request $request): RedirectResponse
    {
//        dd($request->times_taken_daily);
        $user_id = Auth::id();
//        dd($user_id);
//        dd($request->all());
        $validatedData = $request->validate([
            'times_taken_daily' => 'required|integer|max:11',
        ]);
//        dd($validatedData);
//        $user_id = Auth::id();
//        dd($user_id);
        $validatedData['user_id'] = $user_id; // Add user_id

        MedicationAdministration::create($validatedData);



        return redirect()->route('events.index')->with('success', 'Medication taken daily created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(MedicationAdministration $medicationAdministration)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(MedicationAdministration $medicationAdministration)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, MedicationAdministration $medicationAdministration)
    {
        if ($medicationAdministration->user_id !== Auth::id()) {
            abort(403);
        }

        $validatedData = $request->validate([
            'times_taken_daily' => 'required|integer|max:11',
        ]);

        $medicationAdministration->update($validatedData);

        $this->updateMedicationTimes($medicationAdministration);

        return redirect()->route('events.index')->with('success', 'Medication administration updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MedicationAdministration $medicationAdministration)
    {
        //
    }

    public function createMedicationTimes()
    {
        $user_id = Auth::id();
        $record = MedicationAdministration::where('user_id', $user_id)->first();
        if ($record) {
            $timesTakenDaily = $record->times_taken_daily;
            $medicationAdministrationId = $record->id;

            $userToday = $this->timezoneService->getTodayInUserTimezone();
            $userTomorrow = $this->timezoneService->getTomorrowInUserTimezone();


            // Check if rows already exist for today
            $existingCount = Event::where('medication_administration_id', $medicationAdministrationId)
                ->where('date', '>=', $userToday)
                ->where('date', '<', $userTomorrow)
                ->count();


            if ($existingCount < $timesTakenDaily) {
                // Calculate how many more rows to create
                $rowsToCreate = $timesTakenDaily - $existingCount;
                $currentTime = Carbon::now();
                $formattedTime = $currentTime->toTimeString();

                for ($i = 0; $i < $rowsToCreate; $i++) {
                    Event::create([
                        'user_id' => $user_id,
                        'medication_administration_id' => $medicationAdministrationId,
                        'date' => $userToday,
                        'time' => $formattedTime,
                    ]);
                }

                return response()->json(['message' => $rowsToCreate . ' Medication Times created.']);
            } else {
                return response()->json(['message' => 'Medication Times already created for today.']);
            }
        } else {
            return response()->json(['message' => 'Medication administration record not found'], 404);
        }

    }

    public function updateMedicationTimes(MedicationAdministration $medicationAdministration)
    {
        $user_id = Auth::id();
        $timesTakenDaily = $medicationAdministration->times_taken_daily;
        $medicationAdministrationId = $medicationAdministration->id;

        $userToday = $this->timezoneService->getTodayInUserTimezone();
        $userTomorrow = $this->timezoneService->getTomorrowInUserTimezone();

        // Get existing rows for today
        $existingEvents = Event::where('medication_administration_id', $medicationAdministrationId)
            ->where('date', '>=', $userToday)
            ->where('date', '<', $userTomorrow)
            ->get();

        $existingCount = $existingEvents->count();

        if ($existingCount < $timesTakenDaily) {
            // Create additional rows
            $rowsToCreate = $timesTakenDaily - $existingCount;
            $currentTime = Carbon::now();
            $formattedTime = $currentTime->toTimeString();

            for ($i = 0; $i < $rowsToCreate; $i++) {
                Event::create([
                    'user_id' => $user_id,
                    'medication_administration_id' => $medicationAdministrationId,
                    'date' => $userToday,
                    'time' => $formattedTime,
                ]);
            }
        } elseif ($existingCount > $timesTakenDaily) {
            // Delete excess rows
            $rowsToDelete = $existingCount - $timesTakenDaily;

            // Delete the oldest rows first
            $eventsToDelete = $existingEvents->sortByDesc('created_at')->take($rowsToDelete);

            foreach ($eventsToDelete as $event) {
                $event->delete();
            }
        } else {
            //Number of rows is the same, just update dates.
            foreach($existingEvents as $event){
                $event->date = $userToday;
                $event->save();
            }
        }

    }



}
