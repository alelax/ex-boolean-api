<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/insegnanti', 'Api\TeacherController@index');
Route::get('/insegnanti/{id}', 'Api\TeacherController@showTeacher');




Route::get('/studenti', 'Api\StudentController@index');
Route::get('/studenti/{id}', 'Api\StudentController@showStudent');

Route::post('/studente', 'Api\StudentController@addStudent');



Route::get('/corsi', 'Api\CourseController@index');
Route::get('/corsi/{id}', 'Api\CourseController@showCourse');


