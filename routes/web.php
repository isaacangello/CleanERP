<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\FinanceController;
use App\Http\Controllers\ServicesController;
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


//#############################################################
//############ RESOURCES CUSTOMERS EMPLOYEES SERVICES NAD ETC
//#############################################################
Route::resources([
   'customers' => CustomerController::class,
    'employees' => EmployeeController::class,
    'services' => ServicesController::class,
]);
//#############################################################
//############ FINANCE
//#############################################################
Route::prefix('finances')->group(function () {
    Route::get('/', [FinanceController::class, 'index'])->middleware(['auth', 'verified'])->name('finances');
    Route::get('/detailer/{id}/{from}/{till}', [FinanceController::class, 'detail_employee'])->middleware(['auth', 'verified'])->name('finances.detailer');
});

//#############################################################
//############ AUTH MIDDLEWARE
//#############################################################
Route::middleware('auth')->group(function () {

    Route::get('/home',[IndexController::class,'home'])->name('home');
    Route::get('/week',[ServicesController::class,'week'])->name('week');
    Route::post('/confirm/{id}',[ServicesController::class,'confirm'])->name('confirm');


    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
//#############################################################
//############ API
//#############################################################

require __DIR__.'/auth.php';
