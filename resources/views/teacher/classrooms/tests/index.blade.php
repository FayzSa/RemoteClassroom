@extends('layouts.app')
@section('title','Tests')
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
                    <h2>Classroom's Tests</h2>
                    
                </div>
            </div>
        </div>
    </div>
</section>



@endsection
@section('content')
<div class="row">
    <div class="col-12">
    <h1>Tests</h1>    
    </div>







 <!-- ##### Popular Course Area Start ##### -->
 <section class="popular-courses-area section-padding-100">
    <div class="container">
        <div class="row">

            @foreach ($tests as $test)
            <!-- Single Popular Course -->
            <div class="col-12 col-md-6 col-lg-4">
                <div class="single-popular-course mb-100 wow fadeInUp" data-wow-delay="250ms">
                    <img src="https://firebasestorage.googleapis.com/v0/b/elearningapp-30a10.appspot.com/o/undraw_exams_g4ow.png?alt=media&token=0d531146-5243-42c9-b465-0d02f5db509f" alt="">
                    <!-- Course Content -->
                    <div class="course-content">
                        <h4> {{$test->title}}</h4>
                        <div class="meta d-flex align-items-center">
                            <a href="#">Last Day</a>
                            <span><i class="fa fa-circle" aria-hidden="true"></i></span>
                            <a href="#"> {{$test->lastDay}}</a>
                        </div>
                        <p> {{$test->description}}</p>
                    </div>
                    <!-- Seat Rating Fee -->
                    <div class="seat-rating-fee d-flex justify-content-between">
                        <div class="seat-rating h-100 d-flex align-items-center">
                            <div class="seat">
                                Delay 
                            </div>
                            <div class="rating">
                               {{$test->delay}} Day(s)
                            </div>
                        </div>
                        <div class="course-fee h-100">
                            <a href="{{ route('classroom.tests.show',['testID'=>$test->testID , 'classroomID'=> $classroomID ?? '']) }}" class="free">See</a>
                        </div>

                    </div>

                      
                   
                        <a href="{{ route('test.edit',['testID'=> $test->testID ,'classroomID'=> $classroomID]) }}" class="btn mt-1 btn-primary col-12">Edit</a>
                        
                   
                        <div class="mt-1">
                    
                            <form method="POST" action="{{ route('test.destroy',['testID'=> $test->testID ,'classroomID'=> $classroomID]) }}">
                               @method('DELETE')
                                @csrf
                                <input type="submit" value="DELETE" class="col-12 btn btn-danger">
                                </form>
                            </div>

                
            </div>
 </div>
@endforeach


       

      
    </div>
</section>
<!-- ##### Popular Course Area End ##### -->

@endsection