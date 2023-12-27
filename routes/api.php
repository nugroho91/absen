<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\KaryawanController;
use App\Http\Controllers\AbsensiController;
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

Route::get('/departments', [DepartmentController::class, 'getAllDepartments']);
Route::get('/departments/filter', [DepartmentController::class, 'getDepartmentsByName']);
Route::post('/departments', [DepartmentController::class, 'createDepartment']);
Route::put('/departments/{id}', [DepartmentController::class, 'editDepartment']);

Route::get('/karyawan', [KaryawanController::class, 'getAllKaryawan']);
Route::post('/karyawan', [KaryawanController::class, 'store']);
Route::get('/karyawan/{id}', [KaryawanController::class, 'show']); 
Route::put('/karyawan/{id}', [KaryawanController::class, 'update']); 
Route::get('/karyawan/birthday', [KaryawanController::class, 'birthday']);


Route::post('/absen/masuk', [AbsensiController::class, 'absenMasuk']);
Route::post('/absen/pulang', [AbsensiController::class, 'absenPulang']);
Route::get('/absen/masuk', [AbsensiController::class, 'getAbsenMasuk']);
