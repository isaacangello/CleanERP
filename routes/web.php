<?php

use App\Http\Controllers\CommercialController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\FinanceController;
use App\Http\Controllers\ServicesController;
use Illuminate\Support\Facades\Route;
use App\Livewire\ConfigEditor;
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
    Route::get('/detailer/{id}/{from}/{till}', \App\Livewire\Finance\Detailer::class)->middleware(['auth', 'verified'])->name('finances.detailer');
    Route::get('/report/{id}/{from}/{till}/{message?}', [\App\Http\Controllers\FinanceReportController::class, 'index'])->middleware(['auth', 'verified'])->name('finances.report');
    Route::get('/report/{id}/{from}/{till}/{message?}/export', [\App\Http\Controllers\FinanceReportController::class, 'generate_pdf'])->middleware(['auth', 'verified'])->name('finances.report.export');
    Route::get('/billings', \App\Livewire\Finance\Billings::class);
    Route::get('/payments',\App\Livewire\Finance\PaymentsReg::class);
});


//#############################################################
//############ AUTH MIDDLEWARE
//#############################################################
Route::middleware('auth')->group(function () {

//#############################################################
//############ RESIDENTIAL ROUTES
//#############################################################

    Route::get('/home',[IndexController::class,'home'])->name('home');
    Route::get('/week',\App\Livewire\Residential\Week::class)->name('week');
    Route::get('/week/search',\App\Livewire\SearchScreen::class)->name('week.search');

    Route::get('/week/pdf',[\App\Http\Controllers\PdfController::class, 'index'])->name('week.pdf');
    Route::get('/week/pdf/{from}/{till}',[\App\Http\Controllers\PdfController::class, 'index'])->name('week.pdf');
    Route::get('/week/pdf/{from}/{till}/export',[\App\Http\Controllers\PdfController::class, 'generatePDF'])->name('week.pdf.export');
    Route::post('/confirm/{id}',[ServicesController::class,'confirm'])->name('confirm');
//#############################################################
//############ COMMERCIAL ROUTES
//#############################################################
    Route::get('/commercial-schedule',\App\Livewire\Commercial\Schedule::class)->name('commercial.schedule');
    Route::get('/commercial-schedule/search',\App\Livewire\SearchScreen::class)->name('commercial.schedule.search');

//#############################################################
//############ PROFLIE ROUTES
//#############################################################
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
//#############################################################
//############ CONFIG AND OTHERS ROUTES
//#############################################################
Route::get('/config',\App\Livewire\ConfigEditor::class)->name('config');

//#############################################################
//############ API
//#############################################################

require __DIR__.'/auth.php';
