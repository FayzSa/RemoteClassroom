@extends('layouts.app')
@section('title','Edit')
@section('classnav')
@include('teacher.classrooms.navClassroom')
@endsection

@section('start')


<section class="hero-area bg-img bg-overlay-2by5" style="background-image: url({{ asset('clever/img/bg-img/bg1.jpg') }});">
    <div class="container h-100">
        <div class="row h-100 align-items-center">
            <div class="col-12">
                <!-- Hero Content -->
                <div class="hero-content text-center">
                    <h2>Edit Classroom's Course</h2>
                    
                </div>
            </div>
        </div>
    </div>
</section>



@endsection
@section('content')
<div class="row">
    <div class="col-12">
    <h1> Edit Your Course </h1>    
    </div>
</div>

<form action="{{ route('course.update',['courseID'=> $course->course_id ,'classroomID'=> $classroomID]) }}" method="POST" enctype="multipart/form-data">
  
    @method('PATCH')
    @include('teacher.classrooms.courses.form')
    <input type="submit" class='btn btn-primary'value="Save Classroom">
    </form>
        @endsection 