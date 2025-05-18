<?php

namespace App\Http\Controllers;

use App\Models\main_control;
use App\Models\TimeControl;
use Illuminate\Http\Request;

class TimeControlController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $master = main_control::all();
        $time = TimeControl::all();
        return view('controlling', compact('master', 'time'));
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(TimeControl $timeControl)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TimeControl $timeControl)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'schedule_time' => 'required|date_format:H:i',
        ]);

        // Append ":00" to the schedule_time to ensure seconds are set to 00
        $scheduleTime = $request->input('schedule_time') . ':00';

        // Retrieve the TimeControl model by ID
        $timeControl = TimeControl::findOrFail($id);

        $timeControl->schedule_time = $scheduleTime;
        $timeControl->save();

        return redirect()->back()->with('success', 'Schedule time updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TimeControl $timeControl)
    {
        //
    }
}
