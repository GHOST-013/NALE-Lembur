<?php

use App\Http\Controllers\Api\AdminController;
use App\Http\Controllers\Api\EmployeeController;
use App\Http\Controllers\Api\OvertimeRecordController;
use Illuminate\Support\Facades\Route;

Route::post('admin/login', [AdminController::class, 'login']);

Route::middleware('auth.admin')->group(function () {
    Route::apiResource('employees', EmployeeController::class);
    Route::apiResource('overtime-records', OvertimeRecordController::class);
});