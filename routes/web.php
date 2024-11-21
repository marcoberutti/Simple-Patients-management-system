<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\InvoiceController;

Auth::routes();

Route::get('/', function () {return view('index');});
Route::get('/index', [App\Http\Controllers\HomeController::class, 'index'])->name('index')->middleware('auth');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('auth');
Route::post('/patients', [PatientController::class, 'store'])->name('patients.store');
Route::get('/database', [PatientController::class, 'databasePatients']);
Route::get('/home/{id}', [PatientController::class, 'show'])->name('home');
Route::put('/home/{id}', [PatientController::class, 'update'])->name('patients.update');


Route::post('/invoices/preview', [InvoiceController::class, 'store'])->name('invoices.store');
// Route::post('/invoices/preview', [InvoiceController::class, 'preview'])->name('invoices.preview');
