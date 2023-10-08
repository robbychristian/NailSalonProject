<?php

namespace App\Http\Controllers;

use App\Models\Branches;
use App\Models\Packages;
use App\Models\ProductAddOns;
use App\Models\Products;
use App\Models\Staff;
use App\Models\User;
use App\Models\UserProfile;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('modules.booking.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('modules.booking.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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

    public function getBranches()
    {
        $branches = Branches::all();
        return response()->json([
            'branches' => $branches
        ]);
    }

    public function getProductsAndPackages()
    {
        $products = Products::all();
        $addons = ProductAddOns::all();
        $packages = Packages::with('products')->get();

        return response()->json([
            'products' => $products,
            'addons' => $addons,
            'packages' => $packages
        ]);
    }

    public function getStaff()
    {
        $staff = Staff::with('workImages')->with('services')->get();

        return response()->json([
            'staff' => $staff
        ]);
    }

    public function getStaffName($id)
    {
        $selectedStaff = Staff::find($id);
        return response()->json([
            'selectedStaff' => $selectedStaff
        ]);
    }

    public function getAllUsers()
    {
        $users = User::where('user_role', 2)->get();

        return response()->json([
            'users' => $users
        ]);
    }

    public function getUserDetails($id)
    {
        $selectedUser = User::find($id);
        $selectedUserProfile = UserProfile::where('user_id', $id)->get();
        return response()->json([
            'selectedUser' => $selectedUser,
            'selectedUserProfile' => $selectedUserProfile,
        ]);
    }
}
