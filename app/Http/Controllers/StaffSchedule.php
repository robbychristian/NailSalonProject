<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
use App\Models\Staff;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StaffSchedule extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $staffId = Staff::where('user_id', Auth::user()->id)->value('id');
        // $schedule = Schedule::with('staff', 'services')->find($staffId);
        $schedule = Schedule::where('staff_id', $staffId)->get();
        // return $schedule;

        $services = [];
        foreach ($schedule as $sched) {
            $services[] = [
                'date' => $sched->date,
                'services' => $sched->services,
                'staff' => $sched->staff
            ];
        }

        // return $services;
        return view('modules.schedule.index', compact('schedule', 'staffId'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $dates = [];

        $currentMonth = Carbon::now()->startOfMonth();
        $lastDayOfMonth = Carbon::now()->endOfMonth();

        while ($currentMonth->lte($lastDayOfMonth)) {
            $dates[] = [
                'date' => $currentMonth->toDateString(),
                'fullDate' => $currentMonth->format('M d'),
                'day' => $currentMonth->format('l')
            ];
            $currentMonth->addDay();
        }

        return view('modules.schedule.create', compact('dates'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $services = [];
        foreach ($request->dates as $date) {
            $selectedServices = $request->input("services.$date", []);

            // $services[] = [
            //     'date' => $date,
            //     'services' => $selectedServices,
            // ];

            $staffId = Staff::where('user_id', Auth::user()->id)->value('id');
            // return $staffId;
            $schedule = Schedule::create([
                'staff_id' => $staffId,
                'date' => $date
            ]);

            $schedule->services()->attach($selectedServices);
        }

        return redirect('/schedule')->with('success', 'You have successfully set your schedule!');
        // return $services;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function getStaffSchedule($id)
    {
        $schedule = Schedule::where('staff_id', $id)->with('services')->get();

        return response()->json([
            'schedule' => $schedule
        ]);
    }

    public function getAllStAffSchedule()
    {
        $schedule = Schedule::with('staff')->get();

        return response()->json([
            'schedule' => $schedule
        ]);
    }
}
