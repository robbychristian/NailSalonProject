<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateStaffRequest;
use App\Http\Requests\UpdateStaffRequest;
use App\Models\Services;
use App\Models\Staff;
use App\Models\User;
use App\Models\UserProfile;
use App\Models\WorkImages;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

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
        // dd($request->all());
        $user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'email_verified_at' => now(),
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'user_role' => 3, // staff role
        ]);

        $userProfile = UserProfile::create([
            'user_id' => $user->id,
            'middle_name' => $request->middle_name,
        ]);
        if ($request->hasFile('staff_image')) {
            $fileName = time() . '-' . $request->staff_image->getClientOriginalName();
            $staff = Staff::create([
                'staff_name' => $request->first_name . ' ' . $request->middle_name . ' ' . $request->last_name,
                'user_id' => $user->id,
                'staff_image' => $fileName
            ]);
            $request->staff_image->move(public_path('img/profile_pictures/' . $staff->id), $fileName);
        }

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

        $staff->newActivity("Staff Created", "created");
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
        $staff = Staff::with('workImages')->with('services')->find($id);
        return view('modules.staff.show', compact('staff'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $staff = Staff::with('workImages', 'user', 'userProfile', 'services')->find($id);
        $services = Services::all();
        return view('modules.staff.edit', compact('staff', 'services'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateStaffRequest $request, $id)
    {
        // dd($request->user_id);
        $user = User::where('id', $request->user_id)->update([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
        ]);

        $userProfile = UserProfile::where('user_id', $request->user_id)->update([
            'middle_name' => $request->middle_name,
        ]);
        if ($request->hasFile('staff_image')) {
            $fileName = time() . '-' . $request->staff_image->getClientOriginalName();
            $staff = Staff::where('id', $id)->update([
                'staff_name' => $request->first_name . ' ' . $request->middle_name . ' ' . $request->last_name,
                'staff_image' => $fileName
            ]);
            $request->staff_image->move(public_path('img/profile_pictures/' . $id), $fileName);
        } else {
            $staff = Staff::where('id', $id)->update([
                'staff_name' => $request->first_name . ' ' . $request->middle_name . ' ' . $request->last_name,
            ]);
        }

        $staff = Staff::find($id);
        $staff->services()->sync($request->services);

        if ($request->hasFile('work_images')) {
            foreach ($request->file('work_images') as $img) {
                $fileName = time() . '-' . $img->getClientOriginalName();
                $img->move(public_path('img/work_images/' . $staff->id), $fileName);

                $workImage = WorkImages::create(['filename' => $fileName]);
                $staff->workImages()->attach($workImage->id);
            }
        }

        if ($request->selected_images != null) {

            foreach ($request->selected_images as $removeImg) {
                WorkImages::find($removeImg)->delete();
                $staff->workImages()->detach($removeImg);
            }
        }
        $staff->newActivity("Staff Edited", "edited");

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
        $staff = Staff::find($id);
        $staff->delete();
        $staff->services()->detach();
        $staff->workImages()->detach();
        $staff->user()->delete();
        $staff->userProfile()->delete();

        $staff->newActivity("Staff Deleted", "deleted");
        return redirect('/staff')->with('success', 'You have successfully deleted a staff!');
    }
}
