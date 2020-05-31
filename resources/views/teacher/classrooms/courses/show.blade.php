@extends('layouts.app')

@section('title', $course->course_id ?? "")
@section('content')

<h3 class='text-muted'>Courses : {{$course->name}}</h3> 
<div class="row"> 
    <div class="col-1">
    <a href="{{ route('course.edit',['courseID'=> $course->course_id ,'classroomID'=> $classroomID]) }}" class="btn btn-success px-4">Edit</a>
    
</div>
    <div class="col-1">

        <form method="POST" action="{{ route('course.destroy',['courseID'=> $course->course_id ,'classroomID'=> $classroomID]) }}">
           @method('DELETE')
            @csrf
            <input type="submit" value="DELETE" class="btn btn-danger">
            </form>
            <a href="{ { route('classrooms.show',['classroomID'=>$classroom->classroomID]) }}"> {{$course->course_id}}</a>
        </div>
</div>

@endsection