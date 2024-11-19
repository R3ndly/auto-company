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

Route::get('/car/export', [CarController::class, 'exportExcel']);
Route::get('/car/exportCSV', [CarController::class, 'exportCSV']);
Route::get('/car/exportTXT', [CarController::class, 'exportTXT']);
Route::get('/car/exportXML', [CarController::class, 'exportXML']);
Route::get('/car/exportYAML', [CarController::class, 'exportYAML']);

Route::get('/garage/export', [GarageController::class, 'exportExcel']);
Route::get('/garage/exportCSV', [GarageController::class, 'exportCSV']);
Route::get('/garage/exportTXT', [GarageController::class, 'exportTXT']);
Route::get('/garage/exportXML', [GarageController::class, 'exportXML']);
Route::get('/garage/exportYAML', [GarageController::class, 'exportYAML']);

Route::get('/controll/export', [ControllController::class, 'exportExcel']);
Route::get('/controll/exportCSV', [ControllController::class, 'exportCSV']);
Route::get('/controll/exportTXT', [ControllController::class, 'exportTXT']);
Route::get('/controll/exportXML', [ControllController::class, 'exportXML']);
Route::get('/controll/exportYAML', [ControllController::class, 'exportYAML']);

Route::get('/driver/export', [DriverController::class, 'exportExcel']);
Route::get('/driver/exportCSV', [DriverController::class, 'exportCSV']);
Route::get('/driver/exportTXT', [DriverController::class, 'exportTXT']);
Route::get('/driver/exportXML', [DriverController::class, 'exportXML']);
Route::get('/driver/exportYAML', [DriverController::class, 'exportYAML']);

Route::get('/travel/export', [TravelController::class, 'exportExcel']);
Route::get('/travel/exportCSV', [TravelController::class, 'exportCSV']);
Route::get('/travel/exportTXT', [TravelController::class, 'exportTXT']);
Route::get('/travel/exportXML', [TravelController::class, 'exportXML']);
Route::get('/travel/exportYAML', [TravelController::class, 'exportYAML']);

Route::get('/product/export', [ProductController::class, 'exportExcel']);
Route::get('/product/exportCSV', [ProductController::class, 'exportCSV']);
Route::get('/product/exportTXT', [ProductController::class, 'exportTXT']);
Route::get('/product/exportXML', [ProductController::class, 'exportXML']);
Route::get('/product/exportYAML', [ProductController::class, 'exportYAML']);