@extends('layouts.app')
@section('title','Edit')
@section('content')
<h3>Edit {{}}</h3>
<form action="{{ route('classroom.update' , ['classroom' => $classroom]) }}" method="POST" enctype="multipart/form-data">
  
    @method('PATCH')
    @include('teacher.classrooms.form')
    <input type="submit" class='btn btn-primary'value="Save Classroom">
    </form>
        @endsection 