<?php

use App\Http\Controllers\Api as Api;
use Illuminate\Support\Facades\Route;

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
Route::post('/login', [Api\AuthController::class, 'login']);

Route::post('/migrate', function () {
    Artisan::call('migrate');
});
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [Api\AuthController::class, 'logout'])->middleware('throttle:1,1');

    Route::post('/lessons/subscribe/{lesson}', [Api\LessonController::class, 'subscribe'])->middleware('throttle:1,1');
    Route::post('/lessons/unsubscribe/{lesson}', [Api\LessonController::class, 'unsubscribe'])->middleware('throttle:1,1');

    Route::get('/lessons', [Api\LessonController::class, 'index']);//kerek emes negizi
    Route::get('/lessons/by-date', [Api\LessonController::class, 'getByDate']);
    Route::get('/lesson/{lesson}', [Api\LessonController::class, 'show']);

    Route::get('/sections', [Api\SectionController::class, 'index']);
    Route::get('/section/{section}', [Api\SectionController::class, 'show']);

    Route::get('/teachers', [Api\TeacherController::class, 'index']);
    Route::get('/teacher/{teacher}', [Api\TeacherController::class, 'show']);

    Route::get('/news', [Api\NewsController::class, 'index']);
    Route::get('/news/{news}', [Api\NewsController::class, 'show']);

    Route::get('/events', [Api\EventController::class, 'index']);

    Route::get("/my_lessons", [Api\LessonController::class, 'my_lessons']);

    Route::get('/profile', [Api\ProfileController::class, 'profile']);


//    Route::post('/review/{teacher}',[Api\TeacherController::class, 'preview']);


    //only teachers
    Route::post('/lesson/attendance/{lesson}', [Api\TeacherController::class, 'attendance']);

});
// start
