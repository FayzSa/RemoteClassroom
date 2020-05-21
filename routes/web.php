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
//php artisan make:controller ClassroomsController --model=Classroom
Route::get('/', function () {
    return view('welcome');
});
Route::get('/users', 'UsersController@index');
Route::get('/users/create', 'UsersController@create');
Route::post('/users/store', 'UsersController@store');
Route::get('/users/edit/{id}', 'UsersController@edit');
Route::put('/users/update/{id}', 'UsersController@update');
Route::get('/users/delete/{id}', 'UsersController@destroy');

//Route::resource('teacher/classrooms',"ClassroomsController");



Route::get('teacher/classrooms', 'ClassroomsController@index');
Route::get('teacher/classrooms/create', 'ClassroomsController@create');
Route::post('teacher/classrooms/store', 'ClassroomsController@store');
Route::get('teacher/classrooms/edit/{classroom}', 'ClassroomsController@edit')->name("classroom.edit");
Route::get('teacher/classrooms/show/{id}', 'ClassroomsController@show');
Route::put('teacher/classrooms/update/{classroom}', 'ClassroomsController@update');
Route::delete('teacher/classrooms/{classroom}', 'ClassroomsController@destroy')->name("classroom.destroy");
