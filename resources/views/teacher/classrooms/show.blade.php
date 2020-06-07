@extends('layouts.app')

@section('title', $classroom->className ?? "")
@section('content')
@include('teacher.classrooms.navClassroom')
<div class="row">
    <div class="col-1">
    <a href="{{ route('classroom.edit',['classroomID'=>$classroom->classroomID ]) }}" class="btn btn-success px-4">Edit</a>
    
</div>
    <div class="col-1">

        <form method="POST" action="{{ route('classrooms.destroy',['classroomID'=>$classroom->classroomID]) }}">
           @method('DELETE')
            @csrf
            <input type="submit" value="DELETE" class="btn btn-danger">
            </form>
            <a href="{{ route('classrooms.show',['classroomID'=>$classroom->classroomID]) }}"> {{$classroom->className}}</a>
        </div>
</div>

<div class="col-12">
    <h1>Students</h1>    
    </div>
@foreach ($classroom->students as $student)
        <div class="row">
            <div class="col-2">
                {{$student->userID}}
            </div>
        
            <div class="col-4">
            <a href="{ { route('classrooms.show',['classroomID'=>$student->classroomID]) }}"> {{$student->firstName}}</a>
                </div>
        
           
        
        </div>    
        @endforeach

@endsection