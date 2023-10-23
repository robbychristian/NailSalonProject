<?php

namespace App\Http\Controllers;

use App\Models\Bookings;
use App\Models\Packages;
use App\Models\Payments;
use App\Models\Products;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SalesReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bookings = Bookings::all();
        $today = Carbon::now()->format('Y-m-d');
        $bookingsTodayCount = Bookings::whereDate('date', $today)->count();
        $totalSales = number_format(Payments::where('payment_status', 1)->sum('total_price'), 2);
        $totalProducts = Products::all()->count();
        $totalPackages = Packages::all()->count();

        $months = [
            'January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September',
            'October', 'November', 'December'
        ];

        $months = [
            'January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September',
            'October', 'November', 'December'
        ];

        $numberOfBookings = [];

        foreach ($months as $value) {
            $yearMonth = date('Y-m', strtotime("1 $value")); // Year and month
            $count = Bookings::whereRaw('DATE_FORMAT(date, "%Y-%m") = ?', [$yearMonth])->count();
            $numberOfBookings[] = $count;
        }

        $typeOfCustomer = [1, null];
        $totalTypeOfCustomer = [];

        foreach ($typeOfCustomer as $key => $value) {
            $totalTypeOfCustomer[] = User::where('is_loyal', $value)
                ->where('user_role', 2)
                ->count();
        }

        $topProducts = Products::withCount('bookings') // Count the number of bookings for each product
            ->having('bookings_count', '>', 0) // Filter products with bookings_count > 0
            ->orderBy('bookings_count', 'desc') // Order by the booking count in descending order
            ->take(10) // Limit the result to the top 10 products
            ->get(); // Get the products

        $topPackages = Packages::withCount('bookings')
            ->having('bookings_count', '>', 0)
            ->orderBy('bookings_count', 'desc')
            ->take(10)
            ->get();

        // return $topPackages;

        return view('modules.reports.salesreport', compact('bookingsTodayCount', 'totalSales', 'totalProducts', 'totalPackages', 'months', 'numberOfBookings', 'totalTypeOfCustomer', 'topProducts', 'topPackages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
}
