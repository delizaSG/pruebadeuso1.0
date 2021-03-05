<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\asignned_company_user;
use App\Http\Controllers\createusercontroller;
use App\Http\Controllers\HomeController;


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
//Para inidicar que está en una carpeta se debe de poner los puntos
Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::get('home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::post('home',[HomeController::class,'store'])->name('home.store');
Route::resource('asigneds',asignned_company_user::class)->names('asigneds');
Route::resource('createusers',createusercontroller::class)->names('createusers');
