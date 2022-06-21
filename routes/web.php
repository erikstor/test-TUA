<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\UserController;
use \App\Http\Controllers\TaskController;

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

    Route::get('/list', [UserController::class, 'index'])->can('users/list')->middleware('auth');
    Route::get('/get-users', [UserController::class, 'getUserList'])->can('users/get-users')->name('get-user');

});


Route::prefix('tasks')->group(function () {

    Route::get('/', function () {
        return redirect('tasks/list');
    })->middleware('auth');
    Route::get('/list', [TaskController::class, 'index'])->can('task/list')->middleware('auth');
    Route::get('/get-quantity-task', [TaskController::class, 'getQuantityTasks'])->name('get-quantity-task')->can('task/get-quantity-task')->middleware('auth');
    Route::get('/find-task/{task}', [TaskController::class, 'show'])->name('find-task')->can('task/find-task/{task}')->middleware('auth');
    Route::put('/update/{task}', [TaskController::class, 'update'])->name('update-task')->can('task/update/{task}')->middleware('auth');
    Route::delete('/delete/{task}', [TaskController::class, 'destroy'])->name('erase-task')->can('task/delete/{task}')->middleware('auth');
    Route::post('/store', [TaskController::class, 'store'])->name('store-task')->can('task/store')->middleware('auth');


});
