@extends('layouts.app')

@section('title','Add New Test')
@section('content')

<form action="{{route('test.store',['classroomID'=> $classroomID])}}" method="post" enctype="multipart/form-data">
    @include('teacher.classrooms.tests.form')
    <input type="submit" class='btn btn-primary'value="Add">
        </form>
        @endsection 