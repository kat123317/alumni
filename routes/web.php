<?php

use App\Http\Controllers\CollegeController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\GraduateController;
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

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::post('/register_user', [UserController::class, 'register'])->name('register_user');


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');

    Route::prefix('yearbooks')->name('yearbooks.')->group(function () {
        Route::get('/index', [YearbookController::class, 'index'])->name('index');
        Route::post('/store', [YearbookController::class, 'store'])->name('store');
        Route::put('/update/{id}', [YearbookController::class, 'update'])->name('update');

        Route::prefix('alumni')->name('alumni.')->group(function () {
            Route::get('/index', [GraduateController::class, 'index'])->name('index');
            Route::post('/store', [GraduateController::class, 'store'])->name('store');
            Route::put('/update/{id}', [GraduateController::class, 'update'])->name('update');
        });
    });

    Route::prefix('colleges')->name('colleges.')->group(function () {
        Route::get('/index', [CollegeController::class, 'index'])->name('index');
        Route::post('/store', [CollegeController::class, 'store'])->name('store');
        Route::put('/update/{id}', [CollegeController::class, 'update'])->name('update');
    });

    Route::prefix('courses')->name('courses.')->group(function () {
        Route::get('/index', [CourseController::class, 'index'])->name('index');
        Route::post('/store', [CourseController::class, 'store'])->name('store');
        Route::put('/update/{id}', [CourseController::class, 'update'])->name('update');
    });
});


Route::get('/alumni', function () {
    return Inertia::render('Yearbook');
})->name("yearbook");


