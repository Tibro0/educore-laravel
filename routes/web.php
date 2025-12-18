<?php

use App\Http\Controllers\Frontend\FrontendController;
use App\Http\Controllers\Frontend\InstructorDashboardController;
use App\Http\Controllers\Frontend\StudentDashboardController;
use Illuminate\Support\Facades\Route;

//////////////////////////////////
Route::get('tibro', function () {
    // return session()->flush();
    return session()->all();
});
////////////////////////////////

/**
 * Frontend Route Start
 */
Route::controller(FrontendController::class)->group(function () {
    Route::get('', 'index')->name('home');
    Route::get('frontend-register-list-style', 'frontendRegisterListStyle')->name('frontend-register-list-style');
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
    Route::get('dashboard', [StudentDashboardController::class, 'index'])->name('dashboard');
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
