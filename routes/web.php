<?php

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

Route::get('/', function () {
    return view('welcome');
});
Route::get('/users', 'UsersController@index');
Route::get('/users/create', 'UsersController@create');
Route::post('/users/store', 'UsersController@store');
Route::get('/users/edit/{id}', 'UsersController@edit');
Route::put('/users/update/{id}', 'UsersController@update');
Route::get('/users/delete/{id}', 'UsersController@destroy');

Route::get('/createlive', function () {
    return view('teacher.classrooms.createmeeting');
});
Route::get('/joinlive', function () {
    return view('teacher.classrooms.joinmeeting');
});

Route::post('/live/create','ClassroomsController@create_meeting')->name('live.create');
Route::post('/live/join','ClassroomsController@join_meeting')->name('live.join');
//Route::resource('teacher/classrooms',"ClassroomsController");
Route::get('teacher/classrooms', 'ClassroomsController@index');
Route::get('teacher/classrooms/create', 'ClassroomsController@create');
Route::post('teacher/classrooms/store', 'ClassroomsController@store')->name("classrooms.store");
Route::get('teacher/classrooms/edit/{classroomID}', 'ClassroomsController@edit')->name("classroom.edit");
Route::get('teacher/classrooms/show/{classroomID}', 'ClassroomsController@show')->name("classrooms.show");
Route::patch('teacher/classrooms/{classroomID}', 'ClassroomsController@update')->name("classrooms.update");
Route::delete('teacher/classrooms/{classroomID}', 'ClassroomsController@destroy')->name("classrooms.destroy");

