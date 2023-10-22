<?php

namespace App\Http\Controllers;

use App\Models\Bookings;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if (Auth::user()->user_role == 1) {
            $bookings = Bookings::all();
            $today = Carbon::now()->format('Y-m-d');
            $bookingsTodayCount = Bookings::whereDate('date', $today)->count();
            $bookingsCount = Bookings::all()->count();
            $usersCount = User::where('user_role', 2)->count();
            return view('home', compact('bookings', 'bookingsTodayCount', 'bookingsCount', 'usersCount'));
        } else {
            $bookings = Bookings::where('user_id', Auth::user()->id)->get();
            return view('home', compact('bookings'));
        }
    }
}
