<?php

use App\Http\Controllers\CommercialController;
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
//############ ADVANCED ROUTES
//#############################################################
//customers
Route::get('customers/filter/{filter}',[CustomerController::class,'index'])->name('customers.filtered');
Route::get('customers/filter/{filter}/order/{order}',[CustomerController::class,'index'])->name('customers.filtered');
//employees
Route::get('employees/filter/{filter}',[EmployeeController::class,'index'])->name('employees.filtered');
Route::get('employees/filter/{filter}/order/{order}',[EmployeeController::class,'index'])->name('employees.filtered');
//#############################################################
//############ FINANCE
//#############################################################
Route::prefix('finances')->group(function () {
    Route::get('/', \App\Livewire\Finance\Index::class)->middleware(['auth', 'verified'])->name('finances');
    Route::get('/detailer/{id}/{from}/{till}', [FinanceController::class, 'detail_employee'])->middleware(['auth', 'verified'])->name('finances.detailer');
    Route::get('/billings', \App\Livewire\Finance\Billings::class);
});


//#############################################################
//############ AUTH MIDDLEWARE
//#############################################################
Route::middleware('auth')->group(function () {

//#############################################################
//############ RESIDENTIAL ROUTES
//#############################################################

    Route::get('/home',[IndexController::class,'home'])->name('home');
    Route::get('/week',[ServicesController::class,'week'])->name('week');
    Route::post('/confirm/{id}',[ServicesController::class,'confirm'])->name('confirm');
//#############################################################
//############ RESIDENTIAL ROUTES
//#############################################################
Route::get('/commercial-schedule',[CommercialController::class,'index'])->name('commercial.schedule');


//#############################################################
//############ PROFLIE ROUTES
//#############################################################
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
//#############################################################
//############ API
//#############################################################

require __DIR__.'/auth.php';
