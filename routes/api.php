<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('/employees/create', [App\Http\Controllers\EmployeesController::class, 'store']);
Route::get('/employees/edit/{id}', [App\Http\Controllers\EmployeesController::class, 'edit']);
Route::get('/employees', [App\Http\Controllers\EmployeesController::class, 'index']);
Route::post('/employees/update/{id}', [App\Http\Controllers\EmployeesController::class, 'update']);
Route::delete('/employees/delete/{id}', [App\Http\Controllers\EmployeesController::class, 'destroy']);

Route::post('/customers/create', [App\Http\Controllers\CustomerController::class, 'store']);
Route::get('/customers/edit/{id}', [App\Http\Controllers\CustomerController::class, 'edit']);
Route::get('/customers', [App\Http\Controllers\CustomerController::class, 'index']);
Route::post('/customers/update/{id}', [App\Http\Controllers\CustomerController::class, 'update']);
Route::delete('/customers/delete/{id}', [App\Http\Controllers\CustomerController::class, 'destroy']);


Route::post('/users/create', [App\Http\Controllers\UserController::class, 'store']);
Route::get('/users/edit/{id}', [App\Http\Controllers\UserController::class, 'edit']);
Route::get('/users', [App\Http\Controllers\UserController::class, 'index']);
Route::post('/users/update/{id}', [App\Http\Controllers\UserController::class, 'update']);
Route::delete('/users/delete/{id}', [App\Http\Controllers\UserController::class, 'destroy']);



Route::post('/branch/create', [App\Http\Controllers\BranchController::class, 'store']);
Route::get('/branches', [App\Http\Controllers\BranchController::class, 'index']);
Route::get('/branches/edit/{id}', [App\Http\Controllers\BranchController::class, 'edit']);