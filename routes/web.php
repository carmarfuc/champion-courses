<?php

use Illuminate\Support\Facades\Route;

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

Route::resource('settings', App\Http\Controllers\SettingController::class)->middleware('auth');
Route::resource('subjects', App\Http\Controllers\SubjectController::class)->middleware('auth');
Route::resource('courses', App\Http\Controllers\CourseController::class)->middleware('auth');
Route::resource('payments', App\Http\Controllers\PaymentController::class)->middleware('auth');
Route::resource('users', App\Http\Controllers\UserController::class)->middleware('auth');


//Filters
Route::get('users/filter/{filter}', [App\Http\Controllers\UserController::class, 'index'])->middleware('auth');
Route::get('subjects/filter/{filter}', [App\Http\Controllers\SubjectController::class, 'index'])->middleware('auth');
Route::get('payments/filter/{filter}', [App\Http\Controllers\PaymentController::class, 'index'])->middleware('auth');

