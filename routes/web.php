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


// for test only
Route::get('/widget', 'HomeController@testwidget')->name("widget");
//auth routes
Route::get('/login', 'FirebaseController@LoginForm')->name("login");
Route::post('/login', 'FirebaseController@Logincheck')->name("login.check");
Route::post('/logout', 'FirebaseController@logout')->name("logout");
Route::get('/register', 'FirebaseController@RegisterForm')->name("register");
Route::post('/register', 'FirebaseController@Registercheck')->name("register.check");


Route::get('/about', function () {
    return view('about');
})->name('about');




//rachid routes
Route::group([
    'middleware' => 'AdminAuth',
], function () {

    //All the routes after logged in

// admin routes
    Route::get('home', 'HomeController@index')->name("home");
    Route::get('profile', 'AdminController@index')->name("profile");
    Route::put('/profile', 'AdminProfileController@update')->name('profile.update');
    Route::get('teachers', 'AdminController@ListeTeachers')->name("teachers");
    Route::get('/teachers/status/{id}', 'AdminController@teacherssettings')->name('teachers.status');
    Route::get('students', 'AdminController@ListeStudents')->name("students");
    Route::get('/students/status/{id}', 'AdminController@studentssettings')->name('students.status');
    Route::get('admins', 'AdminController@Admins')->name("admins");
    Route::get('admins/create', 'AdminController@create')->name('admins.create');
    Route::put('/admins/store', 'AdminController@store')->name('admins.store');
    Route::get('/admins/status/{id}', 'AdminController@destroy')->name('admins.status');
    Route::get('/Admin/Settings', 'AdminController@settings')->name("Admin.Settings");
    Route::put('/Admin/Settings', 'AdminProfileController@settingsUpdate')->name('Admin.Settings.update');
    Route::post('/Admin/Settings', 'AdminProfileController@disableaccount')->name('Admin.Settings.disable');
// about
    Route::get('/about', 'AdminController@about')->name("about");



});

//


// teachers routes
Route::group([
    'middleware' => 'TeacherAuth',
], function () {


// profile here

    Route::get('Teacher/Profile/settings', 'ProfileController@settings')->name("Teacher.Settings");
    Route::put('Teacher/Profile/settings', 'ProfileController@settingsUpdate')->name('Teacher.Settings.update');
    Route::post('Teacher/Profile/settings', 'ProfileController@disableaccount')->name('Teacher.Settings.disable');
    Route::get('Teacher/profile', 'ProfileController@index')->name("Teacher.Profile");
    Route::put('Teacher/Profile/update', 'ProfileController@update')->name('Teacher.update');

// profile ends here


    Route::get('teacher/classrooms/createmeeting/{classroomID}','LivesController@createLive')->name('teacher.createlive');
    Route::get('/joinlive', function () {
        return view('teacher.classrooms.joinmeeting');
    });
    
    Route::post('teacher/classrooms/live/create/{classroomID}','LivesController@create_meeting')->name('live.create');
    Route::post('teacher/classrooms/live/join','LivesController@join_meeting')->name('live.join');
   
    Route::get('teacher/classrooms/live/leave/{classroomID}','LivesController@changeState')->name('live.changestate');
    
    

    Route::post('/live/create/{classroomID}','LivesController@create_meeting')->name('live.create');
    Route::post('/live/join','LivesController@join_meeting')->name('live.join');
    //Route::resource('teacher/classrooms',"ClassroomsController");



    Route::get('teacher/endmeeeting/{classroomID}', 'LivesController@end_meeting')->name('teacher.endMeeting');
    Route::get('teacher/classrooms/requestes/{classroomID}', 'ClassroomsController@requests')->name('classroom.requests');
    Route::get('teacher/classrooms', 'ClassroomsController@index');
    Route::get('teacher/classrooms/create', 'ClassroomsController@create');
    Route::post('teacher/classrooms/store', 'ClassroomsController@store')->name("classrooms.store");
    Route::get('teacher/classrooms/edit/{classroomID}', 'ClassroomsController@edit')->name("classroom.edit");
    Route::get('teacher/classrooms/show/{classroomID}', 'ClassroomsController@show')->name("classrooms.show");
    Route::patch('teacher/classrooms/{classroomID}', 'ClassroomsController@update')->name("classrooms.update");
    Route::delete('teacher/classrooms/{classroomID}', 'ClassroomsController@destroy')->name("classrooms.destroy");
    Route::get('teacher', 'TeacherController@index');


    Route::patch('teacher/classrooms/requestes/{classroomID}/{studentID}', 'ClassroomsController@addStudentToClass')->name("request.add");
    Route::delete('teacher/classrooms//requestes/{classroomID}/{studentID}', 'ClassroomsController@removeStudentFromClass')->name("request.remove");



    Route::get('teacher/classrooms/courses/{classroomID}', 'CoursesController@index')->name("classrooms.courses");
    Route::get('teacher/classrooms/courses/show/{courseID}/{classroomID}', 'CoursesController@show')->name("classrooms.courses.show");
    Route::delete('teacher/classrooms/courses/{courseID}/{classroomID}', 'CoursesController@destroy')->name("course.destroy");
    Route::get('teacher/classrooms/courses/create/{classroomID}', 'CoursesController@create')->name("course.create");
    Route::post('teacher/classrooms/courses/store/{classroomID}', 'CoursesController@store')->name("course.store");
    Route::get('teacher/classrooms/courses/edit/{courseID}/{classroomID}', 'CoursesController@edit')->name("course.edit");
    Route::patch('teacher/classrooms/courses/{courseID}/{classroomID}', 'CoursesController@update')->name("course.update");

    Route::get('teacher/classrooms/courses', function(){
        return redirect("notfound");
    });


    Route::get('teacher/classrooms/tests/{classroomID}', 'TestsController@index')->name("classroom.tests");
    Route::get('teacher/classrooms/tests/show/{testID}/{classroomID}', 'TestsController@show')->name("classroom.tests.show");
    Route::get('teacher/classrooms/tests/create/{classroomID}', 'TestsController@create')->name("test.create");
    Route::post('teacher/classrooms/tests/store/{classroomID}', 'TestsController@store')->name("test.store");
    Route::get('teacher/classrooms/tests/edit/{testID}/{classroomID}', 'TestsController@edit')->name("test.edit");
    Route::delete('teacher/classrooms/tests/{testID}/{classroomID}', 'TestsController@destroy')->name("test.destroy");
    Route::patch('teacher/classrooms/tests/{testID}/{classroomID}', 'TestsController@update')->name("test.update");


    Route::get('teacher/classrooms/sessions/{classroomID}', 'SessionsController@index')->name("classroom.sessions");
    Route::get('teacher/classrooms/sessions/show/{sessionID}/{classroomID}', 'SessionsController@show')->name("classroom.sessions.show");
    Route::get('teacher/classrooms/sessions/create/{classroomID}', 'SessionsController@create')->name("session.create");
    Route::get('teacher/classrooms/sessions/edit/{sessionID}/{classroomID}', 'SessionsController@edit')->name("session.edit");
    Route::post('teacher/classrooms/sessions/store/{classroomID}', 'SessionsController@store')->name("sessions.store");
    Route::patch('teacher/classrooms/sessions/{sessionID}/{classroomID}', 'SessionsController@update')->name("session.update");
    Route::delete('teacher/classrooms/sessions/{sessionID}/{classroomID}', 'SessionsController@destroy')->name("session.destroy");
    Route::patch('teacher/classrooms/courses/{testID}/{classroomID}', 'TestsController@update')->name("test.update");


});




Route::group([
    'middleware' => 'StudentAuth',
], function () {

    Route::get('student/classrooms', 'Etudiant@index');
    Route::get('/student/joinlive/{classroomid}','LivesController@join_meeting')->name('student.joinlive');
    Route::get('/tests', 'Etudiant@get_course');
    Route::get('/student/classroom/exit/{classromID}','Etudiant@exit_class_room')->name('student.classroom.exit');
    Route::get('/student/classroom/join','Etudiant@join_class_room_view')->name('student.classroom.joinview');
    Route::post('student/classroom/sendrequest','Etudiant@join_class_room')->name('student.classroom.joinclass');
    Route::get('/student/classroom/requests','Etudiant@myrequests');
    Route::get('/student/classroom/show/{classroomID}','Etudiant@get_courses_of_classroom')->name('student.classroom.show');
    Route::get('/student/classroom/course/show/{courseID}', 'Etudiant@show_course')->name('student.classroom.course.show');
    Route::post('student/classroom/course/comment','Etudiant@comment')->name('student.classroom.course.comment');




    Route::get('student/classrooms/tests/all', 'Etudiant@get_my_tests')->name('student.classroom.alltests');
    Route::get('student/classrooms/{classroomid}/tests/{testid}','Etudiant@get_test')->name('student.classroom.tests.show');
    Route::get('student/classrooms/{classroomid}/tests/show/all','Etudiant@get_tests_of_classroom')->name('student.classroom.tests');


    Route::get('student/classrooms/tests/{testid}/answer/show/{answerid}', 'AnswerController@show')->name("student.classroom.test.answer");
    Route::get('student/classrooms/tests/{testid}/answer/create', 'AnswerController@create')->name("answer.create");
    Route::post('student/classrooms/tests/{testid}/answer/store', 'AnswerController@store')->name("answer.store");
    Route::get('student/classrooms/tests/{testid}/answer/edit/{answerid}', 'AnswerController@edit')->name("answer.edit");
    Route::delete('student/classrooms/tests/{testid}/answer/delete/{answerid}', 'AnswerController@destroy')->name("answer.destroy");
    Route::patch('student/classrooms/tests/{testid}/answer/update/{answerid}', 'AnswerController@update')->name("answer.update");


    Route::get('student/classrooms/{classroomid}/sessions/{sessionid}', 'Etudiant@get_session_view')->name('student.classroom.session');
    Route::get('student/classrooms/sessions/all', 'Etudiant@get_all_my_sessions')->name('student.classroom.session.all');

    Route::get('student/classrooms/{classroomid}/sessions','Etudiant@getsessions')->name('student.classroom.sessions');


    Route::get('student/profile/settings', 'StudentProfileController@settings')->name("student.settings");
    Route::put('student/profile/settings', 'StudentProfileController@settingsUpdate')->name('student.settings.update');
    Route::post('student/profile/settings', 'StudentProfileController@disableaccount')->name('student.settings.disable');
    Route::get('student/profile', 'StudentProfileController@index')->name("student.profile");
    Route::put('student/profile/update', 'StudentProfileController@update')->name('student.update');
});


Route::get('/', function () {
    return view('');
});
Route::get('/users', 'UsersController@index');
Route::get('/users/create', 'UsersController@create');
Route::post('/users/store', 'UsersController@store');
Route::get('/users/edit/{id}', 'UsersController@edit');
Route::put('/users/update/{id}', 'UsersController@update');
Route::get('/users/delete/{id}', 'UsersController@destroy');


