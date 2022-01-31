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
    Route::get('/instructors/all', 'UserController@countTotalInstructors')->name('instructors.all');
    Route::get('/students/all', 'UserController@countTotalStudents')->name('students.all');
    Route::get('/course/all', 'CourseController@countTotalCourses')->name('courses.all');
});

Route::get('/', function () {
    return view('welcome');
});

Route::get('/courses/last', 'CourseController@lastCourses')->name('courses.last');
Route::get('/activities/last', 'ActivityController@lastActivities')->name('activities.last');
Route::get('/instructors/last', 'UserController@lastInstructors')->name('instructors.last');
Route::get('/students', 'StudentController@students')->name('students');

Route::group(['prefix' => 'graph', 'as' => 'graph.'], function () {
    Route::get('/enrolments', 'GraphController@getEnrolments')->name('graph.enrolments');
    Route::get('/completions', 'GraphController@getCompletions')->name('graph.completions');
    Route::get('/methods', 'GraphController@getEnrolmentMethods')->name('graph.methods');
});

Route::apiResource('constructor', 'ConstructorController');

Route::get('/export', 'ExportController@exportCsv')->name('export.csv');


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
