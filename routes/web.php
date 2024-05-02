<?php

use App\Models\Student;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Support\Facades\Route;

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

Route::get('/asd', function () {
    Artisan::call('storage:link');
});

Route::get('/dsa', function () {
    Artisan::call('optimize:clear');
});


//Route::get('/asd',function (){
//    dd(Teacher::with('user')->pluck('name', 'id')->toArray());
//});