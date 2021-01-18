<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HotelController;
use App\Http\Controllers\ReserveController;

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

Auth::routes();

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/admin/dashboard', function () {
    if(Auth::user()->role == 'Admin') return view('admin.dashboard');
    return abort('403');
})->name('admin');

Route::get('/admin/reserve', [App\Http\Controllers\ReserveController::class, 'index'])->name('admin.reserve');
Route::get('/reserve', [App\Http\Controllers\ReserveController::class, 'create'])->name('reserve.create');
Route::post('/reserve', [App\Http\Controllers\ReserveController::class, 'reserve'])->name('reserve.add');
Route::post('/reserve/pay', [App\Http\Controllers\ReserveController::class, 'pay'])->name('reserve.pay');
Route::post('/reserve/success', [App\Http\Controllers\ReserveController::class, 'store'])->name('reserve.store');
Route::get('/reserveHistory', [App\Http\Controllers\ReserveController::class, 'show'])->name('reserve.show');
Route::delete('/admin/reserve/{reserve}', [App\Http\Controllers\ReserveController::class, 'destroy'])->name('admin.reserve.destroy');

Route::get('/admin/hotel', [App\Http\Controllers\HotelController::class, 'index'])->name('admin.hotel');
Route::get('/admin/hotel/add', [App\Http\Controllers\HotelController::class, 'create'])->name('admin.hotel.create');
Route::post('/admin/hotel', [App\Http\Controllers\HotelController::class, 'store'])->name('admin.hotel.store');
Route::patch('/admin/hotel/{hotel}', [App\Http\Controllers\HotelController::class, 'update'])->name('admin.hotel.update');
Route::delete('/admin/hotel/{hotel}', [App\Http\Controllers\HotelController::class, 'destroy'])->name('admin.hotel.destroy');
Route::post('/admin/hotel/{hotel}/edit', [App\Http\Controllers\HotelController::class, 'edit'])->name('admin.hotel.edit');

Route::get('/admin/pet', [App\Http\Controllers\PetController::class, 'index'])->name('admin.pet');
Route::get('/admin/pet/add', [App\Http\Controllers\PetController::class, 'create'])->name('admin.pet.create');
Route::post('/admin/pet', [App\Http\Controllers\PetController::class, 'store'])->name('admin.pet.store');
Route::patch('/admin/pet/{pet}', [App\Http\Controllers\PetController::class, 'update'])->name('admin.pet.update');
Route::delete('/admin/pet/{pet}', [App\Http\Controllers\PetController::class, 'destroy'])->name('admin.pet.destroy');
Route::post('/admin/pet/{pet}/edit', [App\Http\Controllers\PetController::class, 'edit'])->name('admin.pet.edit');

Route::get('/adoption', [App\Http\Controllers\AdoptionController::class, 'index'])->name('adoption.index');
Route::post('/adoption', [App\Http\Controllers\AdoptionController::class, 'store'])->name('adoption.store');
Route::get('/adoptionStatus', [App\Http\Controllers\AdoptionController::class, 'show'])->name('adoption.show');
Route::get('/admin/adoption', [App\Http\Controllers\AdoptionController::class, 'list'])->name('admin.adoption.list');
Route::patch('/admin/adoption/approve/{adopt}', [App\Http\Controllers\AdoptionController::class, 'approve'])->name('admin.adoption.approve');
Route::patch('/admin/adoption/rejected/{adopt}', [App\Http\Controllers\AdoptionController::class, 'reject'])->name('admin.adoption.reject');