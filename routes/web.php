<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\RoomController as AdminRoomController;
use App\Http\Controllers\Admin\BookingController as AdminBookingController;
use App\Http\Controllers\Admin\CustomerController as AdminCustomerController;

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
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(["prefix"=>"admin/", "as"=>"admin."], function(){
    Route::get('dashboard', [AdminDashboardController::class, 'dashboard'])->name('dashboard');

    Route::group(["prefix" => "room/", "as"=>"room."], function(){
        Route::get('', [AdminRoomController::class,'index'])->name('index');
        Route::get('create', [AdminRoomController::class,'create'])->name('create');
        Route::post('store', [AdminRoomController::class, 'store'])->name('store');
        Route::get('edit/{id}', [AdminRoomController::class, 'edit'])->name('edit');
        Route::put('update/{id}', [AdminRoomController::class, 'update'])->name('update');
        Route::delete('delete/{id}', [AdminRoomController::class, 'destroy'])->name('destroy');
    });

    Route::group(["prefix"=>"booking/", "as" => "booking."], function(){
        Route::get("", [AdminBookingController::class, "index"])->name("index");
        Route::get("create", [AdminBookingController::class, "create"])->name("create");
        Route::post("store", [AdminBookingController::class,"store"])->name("store");
        Route::get("detail/{id}", [AdminBookingController::class, "show"])->name("show");

        Route::get("update-departure/{id}", [AdminBookingController::class, "getDepartureModel"])->name("getDepartureModel");
        Route::post("update-departure/{id}", [AdminBookingController::class, "updateDeparture"])->name("updateDeparture");
    });

    Route::group(["prefix"=>"customers/", "as" => "customer."], function(){
        Route::get("",[AdminCustomerController::class, "index"])->name("index");
    });

    Route::post('get-all-customers', [AdminDashboardController::class, 'getCustomer'])->name('getCustomer');
});
