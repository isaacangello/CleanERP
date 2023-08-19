<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TesteController;
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

Route::get('/', function () {
    return view('index');
});
# rota para o index (login)
Route::get('/index', function () {
    return view('index');
})->name('index');

Route::get('/home', function () {
    return view('home');
})->name('home');
Route::post('/home', function () {
    return view('home');
})->name('home');

Route::get('/week', function () {
    return view('week');
})->name('week');

Route::get('/customers', function () {
    return view('customers');
})->name('customers');

Route::get('/finances', function () {
    return view('finances');
})->name('finances');

Route::get('/loginajax', function () {
    return view('loginajax');
})->name('loginajax');

Route::get('/testehome', function () {
    return view('testehome');
})->name('testehome');

route::get('/get_ajax_login',[TesteController::class,'ajax_return']);
route::post('/get_ajax_login',[TesteController::class,'ajax_return']);
