@extends('layouts.app')
@section('title','Edit')
@section('content')
<h3>Edit {{$test->title}}</h3>
<form action="{{ route('test.update',['testID'=> $test->testID ,'classroomID'=> $classroomID]) }}" method="POST" enctype="multipart/form-data">
    @method('PATCH')
    @include('teacher.classrooms.tests.form')
    <input type="submit" class='btn btn-primary'value="Update">
    </form>
    @endsection 