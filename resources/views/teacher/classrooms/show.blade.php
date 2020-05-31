@extends('layouts.app')

@section('title', $classroom->className ?? "")
@section('content')
<<<<<<< HEAD
<div class="row">
    <div class="col-1">
    <a href="{{ route('classroom.edit',['classroomID'=>$classroom->classroomID ]) }}" class="btn btn-success px-4">Edit</a>
    </div>
=======
@include('teacher.classrooms.navClassroom')
<div class="row">
    <div class="col-1">
    <a href="{{ route('classroom.edit',['classroomID'=>$classroom->classroomID ]) }}" class="btn btn-success px-4">Edit</a>
    
</div>
>>>>>>> 4c1b12788c3ba03083bdb7310c36847d81907097
    <div class="col-1">

        <form method="POST" action="{{ route('classrooms.destroy',['classroomID'=>$classroom->classroomID]) }}">
           @method('DELETE')
            @csrf
            <input type="submit" value="DELETE" class="btn btn-danger">
            </form>
            <a href="{{ route('classrooms.show',['classroomID'=>$classroom->classroomID]) }}"> {{$classroom->className}}</a>
        </div>
</div>

@endsection