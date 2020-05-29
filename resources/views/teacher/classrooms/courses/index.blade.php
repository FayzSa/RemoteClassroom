@extends('layouts.app')
@section('title','Courses')

@section('content')
<div class="row">
    <div class="col-12">
    <h1>Courses </h1>    
    </div>
    <a href="{{ route('course.create',['classroomID'=> $classroomID ?? '']) }}"> Add Course</a>


</div>

<hr>    
    


        <h3 class='text-muted'>Courses :</h3>    
    
        @foreach ($courses as $course)
        <div class="row">
            <div class="col-2">
                {{$course->course_id}}
            </div>
        
            <div class="col-4">
                <a href="{{ route('classrooms.courses.show',['courseID'=>$course->course_id , 'classroomID'=> $classroomID ?? '']) }}"> {{$course->name}}</a>

              
                </div>
        
           
        
        </div>    
        @endforeach
    
@endsection