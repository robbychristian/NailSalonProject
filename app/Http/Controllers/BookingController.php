<?php

namespace App\Http\Controllers;

use App\Models\BookingHasCustomization;
use App\Models\Bookings;
use App\Models\Branches;
use App\Models\NailColors;
use App\Models\NailCustomization;
use App\Models\Packages;
use App\Models\Payments;
use App\Models\ProductAddOns;
use App\Models\Products;
use App\Models\Reviews;
use App\Models\Services;
use App\Models\Staff;
use App\Models\User;
use App\Models\UserProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->user_role == 1) {
            $bookings = Bookings::all();
        } else {
            $bookings = Bookings::where('user_id', Auth::user()->id)->get();
        }
        return view('modules.booking.index', compact('bookings'));
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
        $booking = [
            'user_id' => $request->user_id,
            'date' => $request->date,
            'time_in' => $request->time_in,
            'time_out' => $request->time_out,
            'branch' => $request->branch,
            'staff_id' => $request->staff_id,
            'service1' => $request->service1,
            'addon1' => $request->addon1,
            'service2' => $request->service2,
            'addon2' => $request->addon2,
            'service3' => $request->service3,
            'addon3' => $request->addon3,
            'total_price' => $request->total_price,
            'nail_customization_id' => $request->nail_customization_id
        ];

        $branchId = Branches::where('branch_address', $booking['branch'])->pluck('id')->first();
        $service1 = Products::where('product_name', $booking['service1'])->pluck('id')->first();
        $service2 = Products::where('product_name', $booking['service2'])->pluck('id')->first();
        $service3 = Products::where('product_name', $booking['service3'])->pluck('id')->first();
        $package1 = Packages::where('package_name', $booking['service1'])->pluck('id')->first();
        $package2 = Packages::where('package_name', $booking['service2'])->pluck('id')->first();
        $package3 = Packages::where('package_name', $booking['service3'])->pluck('id')->first();

        $products = [$service1, $service2, $service3];

        $notNullProducts = array_filter($products, function ($value) {
            return $value !== null;
        });

        $addons = [$booking['addon1'], $booking['addon2'], $booking['addon3']];

        $notNullAddOns = array_filter($addons, function ($value) {
            return $value !== null;
        });

        $packages = [$package1, $package2, $package3];

        $notNullPackages = array_filter($packages, function ($value) {
            return $value !== null;
        });

        $nailCustomization = NailCustomization::where('id', $booking['nail_customization_id'])->first();

        $bookingId = Bookings::withTrashed()->count() + 1;

        $bookingDetails = Bookings::create([
            'ref_no' => sprintf("GN-%04d", $bookingId),
            'user_id' => $booking['user_id'],
            'date' => $booking['date'],
            'time_in' => $booking['time_in'],
            'time_out' => $booking['time_out'],
            'branch_id' => $branchId,
            'staff_id' => $booking['staff_id'],
            'booking_status' => 1
        ]);

        if (count($notNullProducts) != 0) {
            foreach ($notNullProducts as $products) {
                $bookingDetails->products()->attach($products);
            }
        }

        if (count($notNullAddOns) != 0) {
            foreach ($notNullAddOns as $addons) {
                $bookingDetails->productsAddOns()->attach($addons);
            }
        }

        if (count($notNullPackages) != 0) {
            foreach ($notNullPackages as $packages) {
                $bookingDetails->packages()->attach($packages);
            }
        }

        $numberOfBookings = Bookings::where('user_id', $booking['user_id'])->count();
        $totalPrice = 0;
        if ($numberOfBookings >= 5) {
            User::where('id', $booking['user_id'])->update([
                'is_loyal' => 1
            ]);
            $totalPrice = $booking['total_price'] * 0.9;
        } else {
            User::where('id', $booking['user_id'])->update([
                'is_loyal' => NULL
            ]);
            $totalPrice = $booking['total_price'];
        }

        $payment = Payments::create([
            'booking_id' => $bookingDetails->id,
            'total_price' => $totalPrice,
            'payment_status' => 0,
        ]);

        if ($nailCustomization) {
            BookingHasCustomization::create([
                'booking_id' => $bookingDetails->id,
                'service_type' => $nailCustomization->service_type,
                'nail_polish_brand' => $nailCustomization->nail_polish_brand,
                'nail_size' => $nailCustomization->nail_size,
                'has_extensions' => $nailCustomization->has_extensions,
                'color' => $nailCustomization->color,
                'skin' => $nailCustomization->skin
            ]);
        }
        // return $numberOfBookings;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $booking = Bookings::with('packages', 'products', 'productsAddOns', 'reviews')->find($id);
        // return $booking;
        return view('modules.booking.show', compact('booking'));
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
        Bookings::find($id)->delete();
        return redirect('/booking')->with('success', 'You have successfully deleted the booking!');
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

    public function getAddOns($id)
    {
        $addons = ProductAddOns::find($id);
        return response()->json([
            'addons' => $addons
        ]);
    }

    public function getAllServices()
    {
        $services = Services::all();
        $products = Products::all();
        $product_add_ons = ProductAddOns::all();
        $packages = Packages::with('products')->get();

        return response()->json([
            'services' => $services,
            'products' => $products,
            'product_add_ons' => $product_add_ons,
            'packages' => $packages,
        ]);
    }

    public function getAllBookings()
    {
        $bookings = Bookings::all();
        return response()->json([
            'bookings' => $bookings
        ]);
    }

    public function getAvailableStaff(Request $request)
    {
        $requestedTimeIn = $request->time_in;
        $requestedTimeOut = $request->time_out;
        $serviceTypes = [
            $request->serviceType1,
            $request->serviceType2,
            $request->serviceType3,
        ];
        $userId = $request->userId;

        // get the major service type for staff
        $serviceTypeCollection = new Collection($serviceTypes);
        $majorValue = $serviceTypeCollection->mode();

        $majorServiceId = implode(',', $majorValue);

        // Retrieve staff members with bookings that overlap with the requested time
        $bookedStaff = Bookings::where(function ($query) use ($requestedTimeIn, $requestedTimeOut) {
            $query->where(function ($query) use ($requestedTimeIn, $requestedTimeOut) {
                $query->where('time_in', '<=', $requestedTimeIn)
                    ->where('time_out', '>=', $requestedTimeIn);
            })->orWhere(function ($query) use ($requestedTimeIn, $requestedTimeOut) {
                $query->where('time_in', '<', $requestedTimeOut)
                    ->where('time_out', '>=', $requestedTimeOut);
            })->orWhere(function ($query) use ($requestedTimeIn, $requestedTimeOut) {
                $query->where('time_in', '>=', $requestedTimeIn)
                    ->where('time_out', '<=', $requestedTimeOut);
            });
        })->pluck('staff_id')->toArray();

        $allStaff = Staff::with('workImages')->with('services')->pluck('id')->toArray();

        // Use array_diff to remove values in $bookedStaff from $allStaff
        $availableStaff = array_diff($allStaff, $bookedStaff);

        // Convert the result back to an indexed array if needed
        $availableStaff = array_values($availableStaff);

        // check user if loyal
        $userStatus = User::where('id', $userId)->pluck('is_loyal')->first();

        if ($userStatus == 1) {
            $staff = Staff::with('workImages')
                ->with('services')
                ->whereIn('id', $availableStaff)
                ->whereHas('services', function ($query) use ($majorServiceId) {
                    $query->where('id', $majorServiceId);
                })
                ->get();

            return response()->json([
                'staff' => $staff
            ]);
        } else if ($userStatus == NULL) {
            $staff = Staff::with('workImages')
                ->with('services')
                ->whereIn('id', $availableStaff)
                ->whereHas('services', function ($query) use ($majorServiceId) {
                    $query->where('id', $majorServiceId);
                })
                ->inRandomOrder() // Randomly order the results
                ->first(); // Get the first result

            if ($staff) {
                return response()->json([
                    'staff' => [$staff]
                ]);
            } else {
                return response()->json([
                    'staff' => []
                ]);
            }
        }
    }

    public function giveReviews($id)
    {
        $booking = Bookings::find($id);
        return view('modules.reviews.create', compact('booking'));
    }

    public function saveReviews(Request $request)
    {
        $review = [
            'user_id' => $request->user_id,
            'booking_id' => $request->booking_id,
            'review_score' => $request->review_score,
            'review_desc' => $request->review_desc,
        ];

        Reviews::create([
            'user_id' => $review['user_id'],
            'booking_id' => $review['booking_id'],
            'review_score' => $review['review_score'],
            'review_desc' => $review['review_desc'],
        ]);

        return response()->json(
            ['redirect' => route('booking.show', $review['booking_id'])]
        );
    }

    public function approveBooking($id)
    {
        $bookId = Payments::where('booking_id', $id)->value('id');
        $payment = Payments::find($bookId);
        Payments::where('booking_id', $id)->update([
            'payment_status' => 1
        ]);

        $payment->newActivity("Booking Approved", "edited");
        return redirect('/booking')->with('success', 'You have successfully approved this booking!');
    }

    // NAIL CUSTOMIZATION 

    public function showNailCustomization()
    {
        return view('modules.booking.nail-custom');
    }

    public function getColorByBrand(Request $request)
    {
        $colors = NailColors::where('brand', $request->brand)->get();
        return response()->json([
            'colors' => $colors
        ]);
    }

    public function storeCustomization(Request $request)
    {
        $data = [
            'user_id' => $request->user_id,
            'service_type' => $request->service_type,
            'nail_polish_brand' => $request->nail_polish_brand,
            'nail_size' => $request->nail_size,
            'has_extensions' => $request->has_extensions,
            'color' => $request->color,
            'skin' => $request->skin
        ];

        $existingCustomization = NailCustomization::where('user_id', $data['user_id'])->first();

        if ($existingCustomization) {
            NailCustomization::where('user_id', $data['user_id'])->update([
                'user_id' => $data['user_id'],
                'service_type' => $data['service_type'],
                'nail_polish_brand' => $data['nail_polish_brand'],
                'nail_size' => $data['nail_size'],
                'has_extensions' => $data['has_extensions'],
                'color' => $data['color'],
                'skin' => $data['skin'],
            ]);
        } else {
            NailCustomization::create([
                'user_id' => $data['user_id'],
                'service_type' => $data['service_type'],
                'nail_polish_brand' => $data['nail_polish_brand'],
                'nail_size' => $data['nail_size'],
                'has_extensions' => $data['has_extensions'],
                'color' => $data['color'],
                'skin' => $data['skin']
            ]);
        }
    }

    public function getNailCustomizationPerUser($id)
    {
        $user = User::with('nailCustomization')->find($id);
        return response()->json([
            'user' => $user
        ]);
    }

    public function getReviewsForServicePage()
    {
        $reviews = Reviews::with('createdBy', 'booking.staffReview')->latest()->take(10)->get();
        return response()->json([
            'reviews' => $reviews
        ]);
    }

    public function getAllBookingsByUser($id)
    {
        $bookings = Bookings::with('packages', 'products', 'productsAddOns', 'reviews', 'branch', 'staff', 'payment', 'user')->where('user_id', $id)->get();
        return response()->json([
            'bookings' => $bookings
        ]);
    }

    public function getIndividualBooking($id)
    {
        $bookings = Bookings::with('packages', 'products', 'productsAddOns', 'reviews', 'branch', 'staff', 'payment', 'user', 'userProfile')->where('id', $id)->get();
        return response()->json([
            'bookings' => $bookings
        ]);
    }

    public function cancelBooking($id)
    {
        Bookings::where('id', $id)->update([
            'booking_status' => 0
        ]);

        return redirect('/booking')->with('success', 'This booking has been successfully cancelled!');
    }
}
