<?php

// require_once __DIR__ . '/../bootstrap.php';

use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcomee');
// });


// pake query url
Route::get('/', function() {
    return view('dashboard');
})->name('dashboard');

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


Route::resource('barang', BarangController::class);
Route::resource('satuan', SatuanController::class);
Route::resource('user', UserController::class);
Route::resource('role', RoleController::class);
Route::resource('vendor', VendorController::class);
Route::resource('margin', MarginController::class);

// user table route
// Route::get('/users', function() {
//     return view('tables.user');
// })->name('users');
//
// // role table route
// Route::get('/roles', function() {
//     return view('tables.role');
// })->name('roles');
