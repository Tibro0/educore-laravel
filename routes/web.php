<?php

use App\Http\Controllers\Frontend\FrontendController;
use App\Http\Controllers\Frontend\InstructorDashboardController;
use App\Http\Controllers\Frontend\ProfileController;
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
    /** Student Dashboard Route */
    Route::controller(StudentDashboardController::class)->group(function () {
        Route::get('dashboard', 'index')->name('dashboard');
        Route::get('become-instructor', 'becomeInstructor')->name('become-instructor');
        Route::post('become-instructor/{user}', 'becomeInstructorUpdate')->name('become-instructor.update');
    });

    /** Profile Routes */
    Route::controller(ProfileController::class)->group(function () {
        Route::get('profile', 'index')->name('profile.index');
        Route::post('profile/update', 'profileUpdate')->name('profile.update');
        Route::post('profile/update-password', 'updatePassword')->name('profile.update-password');
        Route::post('profile/update-social', 'updateSocial')->name('profile.update-social');
    });
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
    /** Instructor Dashboard Route */
    Route::controller(InstructorDashboardController::class)->group(function () {
        Route::get('dashboard', 'index')->name('dashboard');
    });
});
/**
 * ---------------------------------------------------------------------------------------------------
 * Instructor Routs End
 * ------------------------------------------------------------------------------------------------------
 */

require __DIR__ . '/auth.php';
require __DIR__ . '/admin.php';
