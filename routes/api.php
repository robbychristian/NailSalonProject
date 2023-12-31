<?php

use App\Http\Controllers\BookingController;
use App\Http\Controllers\DiscountsController;
use App\Http\Controllers\SalesReportController;
use App\Http\Controllers\StaffSchedule;
use App\Http\Controllers\UserController;
use App\Models\Packages;
use App\Models\ProductAddOns;
use App\Models\Products;
use App\Models\Services;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Auth::routes(['verify' => true]);

Route::resource('users', UserController::class);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('getBranches', [BookingController::class, 'getBranches']);
Route::resource('users', UserController::class);
Route::post('/update-password/{id}', [UserController::class, 'updatePassword'])->name('users.updatePassword');


Route::get('/services-page', function () {
    $services = Services::all();
    $products = Products::all();
    $product_add_ons = ProductAddOns::all();
    $packages = Packages::with('products')->get();
    // return $packages;
    return response([
        'services' => $services,
        'products' => $products,
        'product_add_ons' => $product_add_ons,
        'packages' => $packages,
    ]);
})->name('services-static');
Route::get('getProductsAndPackages', [BookingController::class, 'getProductsAndPackages']);
Route::get('getStaff', [BookingController::class, 'getStaff']);
Route::get('getStaffName/{id}', [BookingController::class, 'getStaffName']);
Route::get('getAllUsers', [BookingController::class, 'getAllUsers']);
Route::get('getUser/{id}', [BookingController::class, 'getUserDetails']);
Route::get('getProductAddOns/{id}', [BookingController::class, 'getAddOns']);
Route::get('getAllServices', [BookingController::class, 'getAllServices']);
Route::get('getAllBookings', [BookingController::class, 'getAllBookings']);
Route::get('getAvailableStaff', [BookingController::class, 'getAvailableStaff']);

Route::get('getColorByBrand', [BookingController::class, 'getColorByBrand']);
Route::post('storeCustomization', [BookingController::class, 'storeCustomization']);
Route::get('getNailCustomizationPerUser/{id}', [BookingController::class, 'getNailCustomizationPerUser']);
Route::get('getReviewsForServicePage', [BookingController::class, 'getReviewsForServicePage']);
Route::resource('booking', BookingController::class);
Route::get('getAllBookingsByUser/{id}', [BookingController::class, 'getAllBookingsByUser']);
Route::get('getIndividualBooking/{id}', [BookingController::class, 'getIndividualBooking']);
Route::post('/saveReviews', [BookingController::class, 'saveReviews']);

Route::get('getStaffSchedule/{id}', [StaffSchedule::class, 'getStaffSchedule']);
Route::get('getAllStaffSchedule', [StaffSchedule::class, 'getAllStaffSchedule']);
Route::get('getApplicableDiscounts', [DiscountsController::class, 'getApplicableDiscounts']);
Route::get('/getDataByYear/{year}', [SalesReportController::class, 'getDataByYear']);
Route::get('/getTopAvailedProducts/{month}/{year}', [SalesReportController::class, 'getTopAvailedProducts']);
Route::get('/getTopAvailedPackages/{month}/{year}', [SalesReportController::class, 'getTopAvailedPackages']);
