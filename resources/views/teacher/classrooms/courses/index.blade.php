@extends('layouts.app')
@section('title','Course')
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
                    <h2>Classroom Courses</h2>
                    
                </div>
            </div>
        </div>
    </div>
</section>



@endsection
@section('content')
<div class="row">
    <div class="col-12">
    <h1>Courses</h1>    
    </div>







 <!-- ##### Popular Course Area Start ##### -->
 <section class="popular-courses-area section-padding-100">
    <div class="container">
        <div class="row">

            @foreach ($courses as $course)
            <!-- Single Popular Course -->
            <div class="col-12 col-md-6 col-lg-4">
                <div class="single-popular-course mb-100 wow fadeInUp" data-wow-delay="250ms">
                    <img src="https://firebasestorage.googleapis.com/v0/b/elearningapp-30a10.appspot.com/o/undraw_tutorial_video_vtd1.png?alt=media&token=7fee7907-bc15-429d-81f0-6b7e0aa0760b" alt="">
                    <!-- Course Content -->
                    <div class="course-content">
                        
                        <div class="meta d-flex align-items-center">
                            <a href="#">Course</a>
                            <span><i class="fa fa-circle" aria-hidden="true"></i></span>
                            <a href="#"> {{$course->name}}</a>
                        </div>
                        <p> 
                        
                            {{ substr($course->description, 0, 80) }} ...
                        </p>
                    </div>
                    <!-- Seat Rating Fee -->
                    <div class="seat-rating-fee d-flex justify-content-end">

                        <div class="course-fee h-100 ">
                        <a href="{{ route('classrooms.courses.show',['courseID'=>$course->course_id , 'classroomID'=> $classroomID ?? '']) }}" type="button" class="free">
                           See
                        </a>
                    </div>

                    </div>
            </div>

     
</div>
@endforeach



        

      
    </div>
</section>

    
@endsection