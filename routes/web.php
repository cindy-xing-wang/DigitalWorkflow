<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\OpsLogController;
use App\Http\Controllers\ChecklistController;
use App\Http\Controllers\HazardReportController;
use App\Http\Controllers\PreFlightLogController;
use App\Http\Controllers\AccidentReportController;

Route::get('/', function () {
    return view('auth/login');
});

Auth::routes();

Route::group(['middleware'=>['auth']], function(){
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::resource('staffs', StaffController::class);
    Route::resource('checklists', ChecklistController::class);
    Route::resource('ops', OpsLogController::class);
    Route::post('/ops/check', [OpsLogController::class, 'check'])->name('ops.check');
    Route::resource('preFlightLogs', PreFlightLogController::class);
    Route::get('/export-excel/{id}', [PreFlightLogController::class, 'exportIntoExcel']);
    Route::get('/reports', function () {
        return view('reports');
    });
    Route::resource('accidentReport', AccidentReportController::class);
    Route::resource('hazardReport', HazardReportController::class);

});