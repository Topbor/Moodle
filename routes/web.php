<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Route::group(['prefix' => 'count', 'as' => 'count.'], function () {
    Route::get('/users/all', 'UserController@countTotalUsers')->name('users.all');
    Route::get('/teachers/all', 'UserController@countTotalInstructors')->name('instructors.all');
    Route::get('/students/all', 'UserController@countTotalStudents')->name('students.all');
    Route::get('/course/all', 'CourseController@countTotalCourses')->name('courses.all');
});

Route::get('/', function () {
    return view('welcome');
});

Route::get('/courses/last', 'CourseController@lastCourses')->name('courses.last');
Route::get('/activities/last', 'ActivityController@lastActivities')->name('activities.last');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
