<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\GarageController;
use App\Http\Controllers\CarController;
use App\Http\Controllers\ControllController;
use App\Http\Controllers\DriverController;
use App\Http\Controllers\TravelController;
use App\Http\Controllers\ProductController;

Route::resource('students', StudentController::class);

Route::resource('garages', GarageController::class);
Route::resource('cars', CarController::class);
Route::resource('controlls', ControllController::class);
Route::resource('drivers', DriverController::class);
Route::resource('travels', TravelController::class);
Route::resource('products', ProductController::class);


Route::get('/', [MainController::class, 'home'])->name('home');
Route::get('/about', [MainController::class, 'about'])->name('about');
Route::get('/contact', [MainController::class, 'contact'])->name('contact');

//Exports

Route::get('/student/export', [StudentController::class, 'exportExcel']);
Route::get('/student/exportCSV', [StudentController::class, 'exportCSV']);
Route::get('/student/exportTXT', [StudentController::class, 'exportTXT']);