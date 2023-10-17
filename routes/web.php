<?php

use App\Http\Controllers\BookingController;
use App\Http\Controllers\BranchController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PackagesController;
use App\Http\Controllers\ProductAddOnsController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\ReviewsController;
use App\Http\Controllers\ServicesController;
use App\Http\Controllers\StaffController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Models\Packages;
use App\Models\ProductAddOns;
use App\Models\Products;
use App\Models\Services;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('static.index');
})->name('index');

Route::get('/about-us', function () {
    return view('static.about-us');
})->name('about-us');

Route::get('/services-page', function () {
    $services = Services::all();
    $products = Products::all();
    $product_add_ons = ProductAddOns::all();
    $packages = Packages::with('products')->get();
    // return $packages;
    return view('static.services', compact('services', 'products', 'product_add_ons', 'packages'));
})->name('services-static');

Auth::routes(['verify' => true]);

Route::group(['middleware' => ['auth', 'verified']], function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::resource('users', UserController::class);
    Route::post('/users-password/{id}', [UserController::class, 'updatePassword'])->name('users.updatePassword');
    Route::resource('services', ServicesController::class);
    Route::resource('products', ProductsController::class);
    Route::resource('product-add-ons', ProductAddOnsController::class);
    Route::resource('packages', PackagesController::class);
    Route::resource('branches', BranchController::class);
    Route::resource('staff', StaffController::class);
    Route::resource('booking', BookingController::class);
    Route::resource('dashboard', DashboardController::class);
    Route::get('/{id}/reviews', [BookingController::class, 'giveReviews'])->name('reviews.create');
    Route::post('/saveReviews', [BookingController::class, 'saveReviews'])->name('reviews.store');
});
