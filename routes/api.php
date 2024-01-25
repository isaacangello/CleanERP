<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ServicesController;
use App\Http\Controllers\Api\CustomerController;
use App\Http\Controllers\Api\EmployeeController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::apiResource('services', ServicesController::class)
->names([
    'index'=>'services.api.index',
    'store'=>'services.api.store',
    'show'=>'services.api.show',
    'update'=>'services.api.update',
    'destroy'=>'services.api.destroy',
]);
Route::apiResource('customer', CustomerController::class)
->names([
    'index'=>'customer.api.index',
    'store'=>'customer.api.store',
    'show'=>'customer.api.show',
    'update'=>'customer.api.update',
    'destroy'=>'customer.api.destroy',
]);
Route::apiResource('employee',  EmployeeController::class)
->names([
    'index'=>'employee.api.index',
    'store'=>'employee.api.store',
    'show'=>'employee.api.show',
    'update'=>'employee.api.update',
    'destroy'=>'employee.api.destroy',
]);
