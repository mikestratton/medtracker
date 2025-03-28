<?php

namespace App\Http\Controllers;

use App\Models\Prescriber;
use App\Models\Prescription;
use App\Http\Requests\StorePrescriptionRequest;
use App\Http\Requests\UpdatePrescriptionRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PrescriptionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user_id = (int) Auth::id();
        $prescriptions = Prescription::where('user_id', $user_id)
            ->orderBy('name', 'asc')
            ->get();

        $prescribers = Prescriber::where('user_id', $user_id)
            ->orderBy('name', 'asc')
            ->get();

        return view('prescriptions.index', compact('prescriptions', 'prescribers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user_id = (int) Auth::id();
        $prescribers = Prescriber::where('user_id', $user_id)
            ->orderBy('name', 'asc')
            ->get();

        return view('prescriptions.create', compact('prescribers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
//        dd($request->all());
        $user_id = Auth::id();
        $validatedData = $request->validate([
            'name' => 'required|string',
            'dosage' => 'required|string',
            'per_day' => 'required|integer|max:11',
            'prescriber_id' => 'required|exists:prescribers,id',
            'time_of_day' => 'string'
        ]);

        $validatedData['user_id'] = $user_id; // Add user_id

        Prescription::create($validatedData);

        return redirect()->route('prescriptions.index')->with('success', 'Prescription created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Prescription $prescriptions)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Prescription $prescriptions)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Prescription $prescription)
    {
        $user_id = Auth::id();

        if ($prescription->user_id !== $user_id) {
            abort(403);
        }

        if ($request->input('_action') === 'delete') {
            $prescription->delete();
            return redirect()->route('prescriptions.index')->with('success', 'Prescription deleted successfully!');
        }

        $validatedData = $request->validate([
            'name' => 'required|string',
            'dosage' => 'required|string',
            'per_day' => 'required|integer|max:11',
            'prescriber_id' => 'required|exists:prescribers,id',
            'time_of_day' => 'string'
        ]);

        $validatedData['user_id'] = $user_id;

        $prescription->update($validatedData);

        return redirect()->route('prescriptions.index')->with('success', 'Prescription updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Prescription $prescription)
    {
        $user_id = Auth::id();
        if ($prescription->user_id != $user_id) {
            abort(403);
        }

        $prescription->delete();
        return redirect()->route('prescriptions.index')->with('success', 'Prescription deleted successfully!');
    }
}
