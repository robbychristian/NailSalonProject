<?php

use App\Http\Controllers\ActivityController;
use App\Http\Controllers\Auth\AdminController;
use App\Http\Controllers\Auth\AuthStaffController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\BranchController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DiscountsController;
use App\Http\Controllers\NailColorController;
use App\Http\Controllers\PackagesController;
use App\Http\Controllers\ProductAddOnsController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\ReviewsController;
use App\Http\Controllers\SalesReportController;
use App\Http\Controllers\ServicesController;
use App\Http\Controllers\SmsController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\StaffSchedule;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Models\Packages;
use App\Models\ProductAddOns;
use App\Models\Products;
use App\Models\Services;
use App\Models\Staff;

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
    $staffs = Staff::all();
    return view('static.about-us', compact('staffs'));
})->name('about-us');

Route::get('/services-page', function () {
    $services = Services::all();
    $products = Products::all();
    $product_add_ons = ProductAddOns::all();
    $packages = Packages::with('products')->get();
    // return $packages;
    return view('static.services', compact('services', 'products', 'product_add_ons', 'packages'));
})->name('services-static');

Route::get('/contact-us', function () {
    return view('static.contact-us');
})->name('contact-us');

Route::get('/login/admin', [AdminController::class, 'showLoginForm'])->name('admin.login');
Route::post('/login/admin', [AdminController::class, 'login'])->name('admin.submit-login');
Route::get('/login/staff', [AuthStaffController::class, 'showLoginForm'])->name('staff.login');
Route::post('/login/staff', [AuthStaffController::class, 'login'])->name('staff.submit-login');
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
    Route::post('/approve-booking/{id}', [BookingController::class, 'approveBooking'])->name('bookings.approve');
    Route::post('/cancel-booking/{id}', [BookingController::class, 'cancelBooking'])->name('bookings.cancel');
    Route::post('/saveReviews', [BookingController::class, 'saveReviews'])->name('reviews.store');
    Route::resource('reports', SalesReportController::class);
    Route::resource('sms', SmsController::class);
    Route::get('/nail-customization', [BookingController::class, 'showNailCustomization'])->name('nail-custom.index');
    Route::resource('nail-colors', NailColorController::class);
    Route::get('/print/reports', [SalesReportController::class, 'print'])->name('reports.print');
    Route::resource('activity', ActivityController::class);
    Route::resource('schedule', StaffSchedule::class);
    Route::resource('discounts', DiscountsController::class);
    Route::get('/discount/products', [DiscountsController::class, 'createProductDiscounts'])->name('discounts.products');
    Route::post('/discount/products', [DiscountsController::class, 'storeProductDiscounts'])->name('discounts.products');
});
