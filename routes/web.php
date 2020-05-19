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
;

Route::get('/users', 'FirebaseController@index');
Route::get('/register', 'FirebaseController@register');
Route::get('/login', 'FirebaseController@login');
Route::get('/remove', 'Etudiant@exit_class_room');
///you can use these url for testing
/// http://127.0.0.1:8000/test/ba8857aa2c3348dda10d
/// and it will gives you all the courses that student have

Route::get('/test/{id_of_user}','Etudiant@test');
/// these to mehtodes to register the student in the firebase with the authentification also
/// i see that we can use a controller to controlle the authentification only for all types of user
/// and if it a student we pass the instance to the student controller same thing for others
/// so with that we can avoid repeating code
Route::get('/student/register', function () {
    return view('student.register');
});
Route::post('/student/create', 'Etudiant@register');
