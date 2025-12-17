<?php

use App\Http\Controllers\Frontend\InstructorDashboardController;
use App\Http\Controllers\Frontend\UserDashboardController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

/**
 * -------------------------------------------------------------------------------------------------
 * Student Routs Start
 * -------------------------------------------------------------------------------------------------
 */
Route::group(['middleware' => ['auth:web', 'verified', 'checkRole:student'], 'prefix' => 'student', 'as' => 'student.'], function () {
    Route::get('dashboard', [UserDashboardController::class, 'index'])->name('dashboard');
});
/**
 * ----------------------------------------------------------------------------------------------------
 * Student Routs End
 * ---------------------------------------------------------------------------------------------------
 */

/**
 * -----------------------------------------------------------------------------------------------------
 * Instructor Routs Start
 * ----------------------------------------------------------------------------------------------------
 */
Route::group(['middleware' => ['auth:web', 'verified', 'checkRole:instructor'], 'prefix' => 'instructor', 'as' => 'instructor.'], function () {
    Route::get('dashboard', [InstructorDashboardController::class, 'index'])->name('dashboard');
});
/**
 * ---------------------------------------------------------------------------------------------------
 * Instructor Routs End
 * ------------------------------------------------------------------------------------------------------
 */

Route::get('/admin/dashboard', function () {
    return view('admin.dashboard');
})->middleware(['auth:admin', 'verified'])->name('admin.dashboard');

require __DIR__ . '/auth.php';
require __DIR__ . '/admin.php';
