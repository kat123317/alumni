<?php

use App\Http\Controllers\CollegeController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\GraduateController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\AdministratorController;
use App\Http\Controllers\AnnouncementController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\SocialMediaController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\YearbookController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {

//     return Inertia::render('Welcome', [
//         'canLogin' => Route::has('login'),
//         'canRegister' => Route::has('register'),
//         'laravelVersion' => Application::VERSION,
//         'phpVersion' => PHP_VERSION,
//     ]);
// });
Route::get('/', [EventController::class, 'welcome'])->name('welcome');


Route::post('/register_user', [UserController::class, 'register'])->name('register_user');


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/administrator', [AdministratorController::class, 'index'])->name('administrator');
   

    // Route::get('/administrator', function () {
    //     Route::get('/', [AnnouncementController::class, 'index'])->name('index');
    
    //     // return Inertia::render('Administrator/Index');
    // })->name("administrator");

    Route::get('/dashboard', [AnnouncementController::class, 'index'])->name('dashboard');

    Route::prefix('yearbooks')->name('yearbooks.')->group(function () {
        Route::get('/', [YearbookController::class, 'index'])->name('index');
        Route::post('/store', [YearbookController::class, 'store'])->name('store');
        Route::put('/update/{id}', [YearbookController::class, 'update'])->name('update');

        
    });
    
    Route::prefix('alumni')->name('graduates.')->group(function () {
        Route::get('/', [GraduateController::class, 'index'])->name('index');
        Route::post('/store', [GraduateController::class, 'store'])->name('store');
        Route::put('/update/{id}', [GraduateController::class, 'update'])->name('update');
    });

    Route::prefix('colleges')->name('colleges.')->group(function () {
        Route::get('/', [CollegeController::class, 'index'])->name('index');
        Route::post('/store', [CollegeController::class, 'store'])->name('store');
        Route::post('/update/{id}', [CollegeController::class, 'update'])->name('update');
        Route::delete('/delete/{id}', [CollegeController::class, 'destroy'])->name('delete');

    });

    Route::prefix('courses')->name('courses.')->group(function () {
        Route::get('/', [CourseController::class, 'index'])->name('index');
        Route::post('/store', [CourseController::class, 'store'])->name('store');
        Route::post('/update/{id}', [CourseController::class, 'update'])->name('update');
        Route::delete('/delete/{id}', [CourseController::class, 'destroy'])->name('delete');
    });

    Route::prefix('announcements')->name('announcements.')->group(function () {
        // Route::get('/', [AnnouncementController::class, 'index'])->name('index');
        Route::post('/store', [AnnouncementController::class, 'store'])->name('store');
        Route::put('/update/{id}', [AnnouncementController::class, 'update'])->name('update');
        Route::delete('/delete/{id}', [AnnouncementController::class, 'destroy'])->name('delete');
        // Route::get('/search', [AnnouncementController::class, 'index'])->name('search');

    });

    Route::post('/register_action', [UserController::class, 'registerAction'])->name('register_action');
    Route::get('/socialmedia', [SocialMediaController::class, 'index'])->name('socialmedia');

    Route::prefix('events')->name('events.')->group(function () {
        Route::get('/', [EventController::class, 'index'])->name('index');
        Route::post('/store', [EventController::class, 'store'])->name('store');
        Route::put('/update/{id}', [EventController::class, 'update'])->name('update');
        Route::delete('/delete/{id}', [EventController::class, 'destroy'])->name('delete');
    });
});



