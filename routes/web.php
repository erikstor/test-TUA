<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\UserController;
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

    if (!auth()->user()) {
        return redirect('/auth/login');
    } else {
        return redirect('inicio');
    }

});

Route::get('/inicio', function () {
    return view('dashboard.home');
})->middleware('auth');


Route::prefix('auth')->group(function () {
    Route::get('/create', function () {
        return view('auth.register');
    });
});


Route::prefix('users')->group(function () {

//    Route::get('/', UserController::class, '');

    Route::get('/list', [UserController::class, 'index'] )->middleware('auth');
    Route::get('/get-users', [UserController::class, 'getUserList'] )->name('get-user');


});
