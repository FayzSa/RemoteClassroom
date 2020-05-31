@extends('layouts.app')

@section('title','Add New Course')
@section('content')

<form action="{{route('course.store',['classroomID'=> $classroomID])}}" method="post" enctype="multipart/form-data">
    @include('teacher.classrooms.courses.form')
    <input type="submit" class='btn btn-primary'value="Add">
        </form>
        @endsection 