<?php

// require_once __DIR__ . '/../bootstrap.php';

use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;
// Route::get('/', function () {
//     return view('welcomee');
// });

Route::get('/403', function() {
    return view('403')->name('403');
});

// pake query url
Route::get('/', function() {
    if (!empty(session())) {
        return redirect()->route('dashboard');
    } else {
        return redirect()->route('login');
    }
});

Auth::routes();

// pake route parameter
// Route::get('/dashboard/{tab?}', [DashboardController::class, 'index'])->name('dashboard');

use App\Http\Controllers\TablesController;
//route to tables
Route::get('/tables', [TablesController::class, 'index'])->name('tables');

use App\Http\Controllers\BarangController;
use App\Http\Controllers\SatuanController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\VendorController;
use App\Http\Controllers\MarginController;


Route::middleware(['login', 'role:1,2,3,4']) //bisa di akses semua akun
    ->group(function () {

        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    });

Route::middleware(['login', 'role:1,2']) //admin
    ->group(function () {
        Route::resource('barang', BarangController::class);
        Route::resource('satuan', SatuanController::class);
        Route::resource('user', UserController::class);
        Route::resource('role', RoleController::class);
        Route::resource('vendor', VendorController::class);
        Route::resource('margin', MarginController::class);
    });

Route::middleware(['login', 'role:4']) //inverntaris
    ->group(function () {
        Route::resource('vendor', VendorController::class);
        Route::resource('barang', BarangController::class);
        Route::resource('satuan', SatuanController::class);
        //penerimaan
        //pengadaan
    });


Route::middleware(['login', 'role:3']) //kasir
    ->group(function () {
        Route::resource('barang', BarangController::class);
        // penjualan
    });



// user table route
// Route::get('/users', function() {
//     return view('tables.user');
// })->name('users');
//
// // role table route
// Route::get('/roles', function() {
//     return view('tables.role');
// })->name('roles');


// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
