<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HelloWorldController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\FindTutorController;
use App\Http\Controllers\TutorController;
use App\Http\Controllers\TutorAvailabilityController;
use App\Http\Controllers\TutorCalendarController;
use App\Http\Controllers\YourScheduleController;
use App\Http\Controllers\HomeController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Auth::routes();


Route::middleware(['auth'])->group(function() {
    Route::get('/profil', [ProfilController::class, 'show']);
    Route::get('/find-tutor', [FindTutorController::class, 'index']);
    Route::get('/tutor-profile/{id}', [TutorController::class, 'showProfile'])->name('showTutorProfile');
    Route::post('/rate-tutor/{id}', [TutorController::class, 'rateTutor'])->name('rate.tutor');
    Route::get('/tutor-calendar/{id}', [TutorCalendarController::class, 'show'])->name('showTutorCalendar');
    Route::get('/find-tutor', [FindTutorController::class, 'index'])->name('findTutor');


    Route::middleware(['can:isUser'])->group(function () {
        Route::get('/your-schedule-user', [YourScheduleController::class, 'index_user']);
        Route::get('tutorScheduleUser/delete/{id}', [YourScheduleController::class, 'delete_user']);
        Route::post('/save-selected-date-time', [TutorCalendarController::class, 'saveSelectedDateTime'])->name('saveSelectedDateTime');
        Route::post('/save-selected-datetime', [TutorCalendarController::class, 'saveSelectedDateTime'])->name('save-selected-datetime');
    });


    Route::middleware(['can:isTutor'])->group(function () {
        Route::post('/tutor/availability', [TutorAvailabilityController::class, 'checkAvailability'])->name('tutor.availability');
        Route::get('/tutor-availability', [TutorAvailabilityController::class, 'index']);
        Route::get('tutorSchedule/delete/{id}', [YourScheduleController::class, 'delete']);
        Route::get('/your-schedule', [YourScheduleController::class, 'index']);
        Route::post('/save-selected-subject', [HomeController::class, 'save'])->name('saveSelectedSubject');

    });

    Route::middleware(['can:isAdmin'])->group(function() {
        Route::get('/users', [UsersController::class, 'index']);
        Route::get('users/delete/{id}', [UsersController::class, 'delete']);
        
    });
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
