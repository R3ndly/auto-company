<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\GarageController;

Route::resource('students', StudentController::class);

Route::resource('garages', GarageController::class);


Route::get('/', [MainController::class, 'home'])->name('home');
Route::get('/about', [MainController::class, 'about'])->name('about');
Route::get('/contact', [MainController::class, 'contact'])->name('contact');

//Exports

Route::get('/student/export', [StudentController::class, 'exportExcel']);
Route::get('/student/exportCSV', [StudentController::class, 'exportCSV']);
Route::get('/student/exportTXT', [StudentController::class, 'exportTXT']);