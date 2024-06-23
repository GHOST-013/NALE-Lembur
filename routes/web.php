<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AdminController;
use App\Http\Controllers\Api\EmployeeController;
use App\Http\Controllers\Api\OvertimeRecordController;

Route::get('/', function () {
    return view('login');
})->name('login');

Route::post('admin/login', [AdminController::class, 'login'])->name('login.post');
Route::post('admin/logout', [AdminController::class, 'logout'])->name('logout');

Route::middleware(['auth.admin'])->group(function () {
    Route::get('/api/overtime-records', [OvertimeRecordController::class, 'index'])->name('api.overtime-records');
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::resource('employees', EmployeeController::class);
    Route::resource('overtime-records', OvertimeRecordController::class);
});