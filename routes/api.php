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

Route::post('/insegnante', 'Api\TeacherController@addTeacher');
Route::post('/insegnante/{id}', 'Api\TeacherController@delete');

Route::put('/insegnante/{id}', 'Api\TeacherController@edit');



Route::get('/studenti', 'Api\StudentController@index');
Route::get('/studenti/{id}', 'Api\StudentController@showStudent');

Route::post('/studente', 'Api\StudentController@addStudent');
Route::post('/studente/{id}', 'Api\StudentController@delete');

Route::put('/studente/{id}', 'Api\StudentController@edit');



Route::get('/corsi', 'Api\CourseController@index');
Route::get('/corsi/{id}', 'Api\CourseController@showCourse');


