<?php

// require_once __DIR__ . '/../bootstrap.php';

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcomee');
});

use App\Http\Controllers\TablesController;

// pake query url
Route::get('/dashboard', function() {
    return view('dashboard');
})->name('dashboard');

// pake route parameter
// Route::get('/dashboard/{tab?}', [DashboardController::class, 'index'])->name('dashboard');

//route to tables
Route::get('/tables', [TablesController::class, 'index'])->name('tables');


// user table route
// Route::get('/users', function() {
//     return view('tables.user');
// })->name('users');
//
// // role table route
// Route::get('/roles', function() {
//     return view('tables.role');
// })->name('roles');
