@extends('layouts.app')
@section('title','Edit')
@section('content')
<h3>Edit {{$classroom->className}}</h3>
<form action="{{ route('classrooms.update',['classroomID'=>$classroom->classroomID]) }}" method="POST" enctype="multipart/form-data">
  
    @method('PATCH')
    @include('teacher.classrooms.form')
    <input type="submit" class='btn btn-primary'value="Save Classroom">
    </form>
        @endsection 