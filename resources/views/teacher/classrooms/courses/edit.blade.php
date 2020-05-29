@extends('layouts.app')
@section('title','Edit')
@section('content')
<h3>Edit {{$course->name}}</h3>
<form action="{{ route('course.update',['courseID'=> $course->course_id ,'classroomID'=> $classroomID]) }}" method="POST" enctype="multipart/form-data">
  
    @method('PATCH')
    @include('teacher.classrooms.courses.form')
    <input type="submit" class='btn btn-primary'value="Save Classroom">
    </form>
        @endsection 