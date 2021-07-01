<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\RoomTypeController as AdminRoomTypeController;
use App\Http\Controllers\Admin\RoomController as AdminRoomController;
use App\Http\Controllers\Admin\BookingController as AdminBookingController;
use App\Http\Controllers\Admin\CustomerController as AdminCustomerController;
use App\Http\Controllers\Admin\AdminController as AdminUserController;
use App\Http\Controllers\Admin\Booking\RoomController as BookingRoomController;
use App\Http\Controllers\Admin\RelativeController as AdminRelativeController;
use App\Http\Controllers\Admin\PaymentController as BookingPaymentController;
use App\Http\Controllers\Admin\UnitController as AdminUnitController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;

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

// Route::get('/home')

Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(["prefix"=>"admin/", "middleware" => "auth", "as"=>"admin."], function(){
    Route::get('dashboard', [AdminDashboardController::class, 'dashboard'])->name('dashboard');

    Route::group(["prefix"=>"user/", "as"=>"user."], function(){
        Route::get("",[AdminUserController::class, "index"])->name("index");
        Route::get("create", [AdminUserController::class, "create"])->name("create");
        Route::post("store", [AdminUserController::class, "store"])->name("store");
        Route::get("edit/{id}", [AdminUserController::class, "edit"])->name("edit");
        Route::put("update/{id}", [AdminUserController::class, "update"])->name("update");
        
        Route::post("update-user-status",[AdminUserController::class,"updateStatus"])->name("updateStatus");

        // User Profile
        Route::get("profile/", [AdminUserController::class, "profile"])->name("profile");
        Route::post("change-admin-password", [AdminUserController::class, "adminNewPassword"])->name("adminNewPassword");
        Route::post("change-admin-email",[AdminUserController::class, "changeAdminEmail"])->name("changeAdminEmail");
        Route::post("change-admin-profile", [AdminUserController::class, "chageAdminAvatar"])->name("chageAdminAvatar");
    });

    Route::group(["prefix"=>"room-type/", "as"=>"room_type."],function(){
        Route::get("", [AdminRoomTypeController::class, "index"])->name("index");
        Route::get("create", [AdminRoomTypeController::class, "create"])->name("create");
        Route::post("store", [AdminRoomTypeController::class, "store"])->name("store");
        Route::get("edit/{id}", [AdminRoomTypeController::class, "edit"])->name("edit");
        Route::put("update/{id}", [AdminRoomTypeController::class, "update"])->name("update");
    });

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
        Route::get("edit/{id}", [AdminBookingController::class, "edit"])->name("edit");
        Route::put("update/{id}", [AdminBookingController::class, "update"])->name("update");

        Route::get("update-departure/{id}", [AdminBookingController::class, "getDepartureModel"])->name("getDepartureModel");
        Route::post("update-departure/{id}", [AdminBookingController::class, "updateDeparture"])->name("updateDeparture");

        Route::group(["prefix" => "payment/", "as"=>"payment."],function(){
            Route::get("create/{id}", [BookingPaymentController::class, "create"])->name("create");
            Route::post("store/{id}",[BookingPaymentController::class, "store"])->name("store");
            Route::get("show/{id}", [BookingPaymentController::class, "show"])->name("show");
        });
    });

    Route::group(["prefix"=>"booking/room/", "as" => "booking_room."],function(){
        Route::get("create-room/{id}", [BookingRoomController::class, "getForm"])->name("getForm");
        Route::post("add-room/{id}", [BookingRoomController::class, "addRoom"])->name("addRoom");
        Route::get("edit/{id}", [BookingRoomController::class, "edit"])->name("edit");
        Route::post("update/{id}", [BookingRoomController::class, "update"])->name("update");
        Route::delete("delete/{id}", [BookingRoomController::class, "destroy"])->name("destroy");
    });

    Route::group(["prefix"=>"relative/", "as"=>"relative."], function(){
        Route::get("create/{id}", [AdminRelativeController::class,"create"])->name("create");
        Route::post("store/{id}", [AdminRelativeController::class, "store"])->name("store");
        Route::get("edit/{id}", [AdminRelativeController::class, "edit"])->name("edit");
        Route::put("update/{id}", [AdminRelativeController::class, "update"])->name("udpate");
        Route::delete("delete/{id}", [AdminRelativeController::class, "destroy"])->name("destroy");
    });

    Route::group(["prefix"=>"customers/", "as" => "customer."], function(){
        Route::get("",[AdminCustomerController::class, "index"])->name("index");
        Route::get("show/{id}", [AdminCustomerController::class, "show"])->name("show");
    });

    // Unit
    Route::group(["prefix"=>"unit/", "as"=>"unit."], function(){
        Route::get("", [AdminUnitController::class, "index"])->name("index");
        Route::get("create", [AdminUnitController::class, "create"])->name("create");
        Route::post("store", [AdminUnitController::class, "store"])->name("store");
        Route::get("edit/{id}", [AdminUnitController::class, "edit"])->name("edit");
        Route::put("update/{id}", [AdminUnitController::class, "update"])->name("update");
    });

    // Product 
    Route::group(["prefix" => "product/", "as" => "product."], function(){
        Route::get("", [AdminProductController::class, "index"])->name("index");
        Route::get("create", [AdminProductController::class, "create"])->name("create");
        Route::post("store", [AdminProductController::class, "store"])->name("store");
        Route::get("edit/{id}", [AdminProductController::class, "edit"])->name("edit");
        Route::put("update/{id}", [AdminProductController::class, "update"])->name("update");
    });

    // Order
    Route::group(["prefix"=> "order/", "as"=>"order."], function(){
        Route::get("", [AdminOrderController::class, "index"])->name("index");
        Route::get("create", [AdminOrderController::class, "create"])->name("create");
        Route::post("store", [AdminOrderController::class, "store"])->name("store");
    });

    

    // Customer Booking Details
    Route::group(["prefix" => "customer/booking/", "as" => "customer.booking."], function(){
        Route::get("detail/{id}", [AdminCustomerController::class, "booking_detail"])->name("detail");
    });

    Route::post('get-all-customers', [AdminDashboardController::class, 'getCustomer'])->name('getCustomer');
    Route::post("get-room-price", [AdminDashboardController::class, "getRoomPrice"])->name("getRoomPrice");
    Route::post("get-room-customers", [AdminDashboardController::class, "getRoomCustomer"])->name("getRoomCustomer");
    Route::post("get-product-details", [AdminDashboardController::class, "getProductDetails"])->name("getProductDetails");
    Route::post("get-all-products", [AdminDashboardController::class, "getProducts"])->name("getProducts");
});