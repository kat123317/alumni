<?php

use App\Http\Controllers\CollegeController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\GraduateController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\AdministratorController;
use App\Http\Controllers\AnnouncementController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\SocialMediaController;
use App\Http\Controllers\SurveyController;
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
    // Route::get('/administrator', [AdministratorController::class, 'index'])->name('administrator');

    Route::prefix('administrator')->name('administrator.')->group(function () {
        Route::get('/', [AdministratorController::class, 'announcement'])->name('announcement');
        Route::get('/yearbook', [AdministratorController::class, 'yearbook'])->name('yearbook');
        Route::get('/alumni', [AdministratorController::class, 'alumni'])->name('alumni'); 
        Route::get('/user_management', [AdministratorController::class, 'user_management'])->name('user_management'); 
        Route::get('/department', [AdministratorController::class, 'department'])->name('department'); 
        Route::get('/course', [AdministratorController::class, 'course'])->name('course'); 
        Route::get('/survey', [AdministratorController::class, 'survey'])->name('survey'); 
        Route::get('/event', [AdministratorController::class, 'event'])->name('event'); 
        Route::get('/notification', [AdministratorController::class, 'notification'])->name('notification'); 
    });

    // Route::get('/administrator', function () {
    //     Route::get('/', [AnnouncementController::class, 'index'])->name('index');
    
    //     // return Inertia::render('Administrator/Index');
    // })->name("administrator");

    Route::get('/dashboard', [AnnouncementController::class, 'index'])->name('dashboard');
    Route::get('/chart', [AnnouncementController::class, 'charts'])->name('charts');

    Route::prefix('yearbooks')->name('yearbooks.')->group(function () {
        Route::get('/', [YearbookController::class, 'index'])->name('index');
        Route::post('/store', [YearbookController::class, 'store'])->name('store');
        Route::put('/update/{id}', [YearbookController::class, 'update'])->name('update');
        Route::delete('/delete/{id}', [YearbookController::class, 'destroy'])->name('delete');
    });
    
    Route::prefix('alumni')->name('graduates.')->group(function () {
        Route::get('/', [GraduateController::class, 'index'])->name('index');
        Route::post('/store', [GraduateController::class, 'store'])->name('store');
        Route::post('/update/{id}', [GraduateController::class, 'update'])->name('update');
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
    Route::put('/deactivate/{id}', [UserController::class, 'deactivate_user'])->name('deactivate_user');
    Route::put('/activate/{id}', [UserController::class, 'activate_user'])->name('activate_user');
    Route::put('/assign_as_admin/{id}', [UserController::class, 'assign_as_admin'])->name('assign_as_admin');
    Route::put('/remove_as_admin/{id}', [UserController::class, 'remove_as_admin'])->name('remove_as_admin');

    Route::prefix('socialmedia')->name('socialmedia.')->group(function () {
        Route::get('/socialmedia', [SocialMediaController::class, 'index'])->name('index');
        Route::post('/store', [SocialMediaController::class, 'store'])->name('store');
        Route::post('/open_notif/{id}', [SocialMediaController::class, 'open_notif'])->name('open_notif');

        Route::get('/user_profile/{id}', [SocialMediaController::class, 'user_profile'])->name('user_profile');
        Route::get('/comments/{id}', [SocialMediaController::class, 'comments'])->name('comments');
        Route::post('/add_comment', [SocialMediaController::class, 'add_comment'])->name('add_comment');
        Route::post('/update_post/{id}', [SocialMediaController::class, 'update_post'])->name('update_post');
        Route::delete('/delete_post/{id}', [SocialMediaController::class, 'delete_post'])->name('delete_post');
        Route::post('/update_comment/{id}', [SocialMediaController::class, 'update_comment'])->name('update_comment');
        Route::delete('/delete_comment/{id}', [SocialMediaController::class, 'delete_comment'])->name('delete_comment');

    });

    Route::prefix('events')->name('events.')->group(function () {
        Route::get('/', [EventController::class, 'index'])->name('index');
        Route::post('/store', [EventController::class, 'store'])->name('store');
        Route::put('/update/{id}', [EventController::class, 'update'])->name('update');
        Route::delete('/delete/{id}', [EventController::class, 'destroy'])->name('delete');
    });

    Route::prefix('surveys')->name('surveys.')->group(function () {
        Route::get('/', [SurveyController::class, 'index'])->name('index');
        Route::post('/store', [SurveyController::class, 'store'])->name('store');
        Route::put('/update/{id}', [SurveyController::class, 'update'])->name('update');
        Route::delete('/delete/{id}', [SurveyController::class, 'destroy'])->name('delete');

        Route::prefix('questions/{survey_id}')->name('questions.')->group(function () {
            Route::get('/', [QuestionController::class, 'index'])->name('index');
            Route::post('/store', [QuestionController::class, 'store'])->name('store');
            Route::put('/update/{id}', [QuestionController::class, 'update'])->name('update');
            Route::delete('/delete/{id}', [QuestionController::class, 'destroy'])->name('delete');
        });
    });
});



