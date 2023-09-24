<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateStaffRequest;
use App\Models\Services;
use App\Models\Staff;
use App\Models\WorkImages;
use Illuminate\Http\Request;

class StaffController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $staff = Staff::all();
        return view('modules.staff.index', compact('staff'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $services = Services::all();
        return view('modules.staff.create', compact('services'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateStaffRequest $request)
    {
        $staff = Staff::create([
            'staff_name' => $request->staff_name
        ]);

        foreach ($request->services as $service) {
            $staff->services()->attach($service);
        }


        if ($request->hasFile('work_images')) {
            foreach ($request->file('work_images') as $img) {
                $fileName = time() . '-' . $img->getClientOriginalName();
                $img->move(public_path('img/work_images/' . $staff->id), $fileName);

                $workImage = WorkImages::create(['filename' => $fileName]);
                $staff->workImages()->attach($workImage->id);
            }
        }

        return redirect('/staff')->with('success', 'You have successfully added a staff!');
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
        $staff = Staff::find($id);
        return view('modules.staff.edit', compact('staff'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CreateStaffRequest $request, $id)
    {
        Staff::where('id', $id)->update([
            'staff_name' => $request['staff_name']
        ]);

        return redirect('/staff')->with('success', 'You have successfully edited a staff!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Staff::find($id)->delete();
        return redirect('/staff')->with('success', 'You have successfully deleted a staff!');
    }
}
