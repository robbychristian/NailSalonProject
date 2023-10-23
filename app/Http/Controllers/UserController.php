<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UpdateUserPasswordRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use App\Models\UserProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::where('user_role', 2)->get();
        return view('modules.user.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('modules.user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateUserRequest $request)
    {
        $user = User::create([
            'first_name' => $request['first_name'],
            'last_name' => $request['last_name'],
            'email' => $request['email'],
            'email_verified_at' => now(),
            'username' => $request['username'],
            'password' => Hash::make($request['password']),
            'user_role' => 2,
            'is_notify' => $request['is_notify'],
        ]);

        $userProfile = UserProfile::create([
            'user_id' => $user->id,
            'middle_name' => $request['middle_name'],
            'birthday' => $request['birthday'],
            'contact_no' => '+63' . $request['contact_no'],
            'address' => $request['address']
        ]);

        return redirect('/users')->with('success', 'You have successfully added a user!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        return view('modules.user.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        return view('modules.user.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request, $id)
    {
        $user = User::where('id', $id)->update([
            'first_name' => $request['first_name'],
            'last_name' => $request['last_name'],
        ]);

        $userProfile = UserProfile::where('user_id', $id)->update([
            'middle_name' => $request['middle_name'],
            'birthday' => $request['birthday'],
            'contact_no' => '+63' . $request['contact_no'],
            'address' => $request['address']
        ]);
        if ($request->isMobile) {
            $updatedUser = DB::table('users')
                ->where('id', $id)
                ->first();
            $updatedUserProfile = DB::table('user_profiles')
                ->where('user_id', $id)
                ->first();

            return response(["success" => "true", "user" => $updatedUser, 'user_profile' => $updatedUserProfile]);
        } else {

            return redirect()->back()->with('success', 'You have successfully edited your profile!');
        }
    }

    public function updatePassword(UpdateUserPasswordRequest $request, $id)
    {
        $user = User::where('id', $id)->update([
            'password' => Hash::make($request['password'])
        ]);

        if ($request['isMobile']) {
            return 'true';
        } else {
            return redirect()->back()->with('success', 'You have successfully edited your password!');
        }
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
}
