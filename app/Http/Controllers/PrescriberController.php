<?php

namespace App\Http\Controllers;

use App\Models\Prescriber;
use App\Http\Requests\StorePrescriberRequest;
use App\Http\Requests\UpdatePrescriberRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PrescriberController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user_id = (int) Auth::id();
        $prescribers = Prescriber::where('user_id', $user_id)
            ->orderBy('name', 'asc')
            ->get();

        return view('prescribers.index', compact('prescribers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('prescribers.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user_id = Auth::id();
        $validatedData = $request->validate([
            'name' => 'required|string',
            'phone' => 'string|nullable',
            'organization' => 'string|nullable'
        ]);

        $validatedData['user_id'] = $user_id; // Add user_id

        Prescriber::create($validatedData);

        return redirect()->route('prescribers.index')->with('success', 'Prescriber created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Prescriber $prescriber)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Prescriber $prescriber)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Prescriber $prescriber)
    {
//        dd($request->all());
        if ($request->input('_action') === 'delete') {
            $prescriber->delete();
            return redirect()->route('prescribers.index')->with('success', 'Prescriber deleted successfully!');
        }

        $user_id = Auth::id();

        if ($prescriber->user_id !== $user_id) {
            abort(403);
        }

        $validatedData = $request->validate([
            'name' => 'string',
            'phone' => 'string|nullable',
            'organization' => 'string|nullable'
        ]);

        $validatedData['user_id'] = $user_id;

        $prescriber->update($validatedData);

        return redirect()->route('prescribers.index')->with('success', 'Prescriber updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Prescriber $prescriber)
    {
        //
    }
}
