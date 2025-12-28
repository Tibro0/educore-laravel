<?php

use App\Http\Controllers\Frontend\CourseContentController;
use App\Http\Controllers\Frontend\CourseController;
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
 * Frontend Routes Start
 */
Route::controller(FrontendController::class)->group(function () {
    Route::get('', 'index')->name('home');
    Route::get('frontend-register-list-style', 'frontendRegisterListStyle')->name('frontend-register-list-style');
});
/**
 * Frontend Routes End
 */

/**
 * -------------------------------------------------------------------------------------------------
 * Student Routes Start
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
 * Student Routes End
 * ---------------------------------------------------------------------------------------------------
 */

/**
 * -----------------------------------------------------------------------------------------------------
 * Instructor Routes Start
 * ----------------------------------------------------------------------------------------------------
 */
Route::group(['middleware' => ['auth:web', 'verified', 'checkRole:instructor'], 'prefix' => 'instructor', 'as' => 'instructor.'], function () {
    /** Instructor Dashboard Route */
    Route::controller(InstructorDashboardController::class)->group(function () {
        Route::get('dashboard', 'index')->name('dashboard');
    });

    /** Profile Routes */
    Route::controller(ProfileController::class)->group(function () {
        Route::get('profile', 'instructorIndex')->name('profile.index');
        Route::post('profile/update', 'profileUpdate')->name('profile.update');
        Route::post('profile/update-password', 'updatePassword')->name('profile.update-password');
        Route::post('profile/update-social', 'updateSocial')->name('profile.update-social');
    });

    /** Course Routes */
    Route::controller(CourseController::class)->group(function () {
        Route::get('courses', 'index')->name('courses.index');
        Route::get('courses/create', 'create')->name('courses.create');
        Route::post('courses/create', 'storeBasicInfo')->name('courses.sore-basic-info');
        Route::get('courses/edit/{id}', 'edit')->name('courses.edit');
        Route::post('courses/update', 'update')->name('courses.update');
    });

    Route::controller(CourseContentController::class)->group(function(){
        Route::get('course-content/create-chapter/{course}', 'createChapterModal')->name('course-content.create-chapter');
        Route::post('course-content/create-chapter/{course}', 'storeChapter')->name('course-content.store-chapter');
    });

    /** Laravel File Manager Routes */
    Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth']], function () {
        \UniSharp\LaravelFilemanager\Lfm::routes();
    });
});
/**
 * ---------------------------------------------------------------------------------------------------
 * Instructor Routes End
 * ------------------------------------------------------------------------------------------------------
 */

require __DIR__ . '/auth.php';
require __DIR__ . '/admin.php';
