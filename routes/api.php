<?php

use App\Http\Controllers\BookingController;
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
