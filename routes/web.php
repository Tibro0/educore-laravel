<?php

use App\Http\Controllers\Frontend\FrontendController;
use App\Http\Controllers\Frontend\InstructorDashboardController;
use App\Http\Controllers\Frontend\UserDashboardController;
use Illuminate\Support\Facades\Route;

/**
 * Frontend Route Start
 */
Route::controller(FrontendController::class)->group(function () {
    Route::get('', 'index')->name('home');
});
/**
 * Frontend Route End
 */

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

require __DIR__ . '/auth.php';
require __DIR__ . '/admin.php';
