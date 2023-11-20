<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\FinanceController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/index', function () {
    return view('index');
})->name('index');

Route::get('/', function () {
    return view('index');
});

Route::post('/authenticate', [IndexController::class , 'authenticate'])->name('login.authenticate');

//Route::get('/home', function () {
//    return view('home');
//})->middleware(['auth', 'verified'])->name('home');
//############################################################# dashboard
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');
//#############################################################
Route::get('/customers', [CustomerController::class, 'index'])->middleware(['auth', 'verified'])->name('customers');
//Route::get('/customers/{page?}', [CustomerController::class, 'index'])->middleware(['auth', 'verified'])->name('customers');
//#############################################################
Route::get('/employees', [EmployeeController::class,'index'])->middleware(['auth', 'verified'])->name('employees');
//#############################################################
//Route::get('/finances', [FinanceController::class, 'index'])->middleware(['auth', 'verified'])->name('finances');
Route::prefix('finances')->group(function () {
    Route::get('/', [FinanceController::class, 'index'])->middleware(['auth', 'verified'])->name('finances');
    Route::get('/detailer/{id}/{from}/{till}', [FinanceController::class, 'detail_employee'])->middleware(['auth', 'verified'])->name('finances.detailer');
});

//#############################################################
Route::middleware('auth')->group(function () {

    Route::get('/home', function () {
    return view('home');
})->name('home');


    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
