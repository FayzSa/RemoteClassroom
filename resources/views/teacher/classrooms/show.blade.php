@extends('layouts.app')

@section('title', $classroom->className ?? "")
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
                    <h2>Welcome To {{$classroom->className}}</h2>
                    
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

@section('content')
<div class="row">
    <div class="col-12">
    <h1> {{$classroom->className}} </h1>    
    </div>
</div>

<hr>  



 <!-- ##### Popular Course Area Start ##### -->
 <section class="popular-courses-area section-padding-100">
    <div class="container">
        <div class="row">

            @foreach($classroom->students as $student)
            <!-- Single Popular Course -->
            <div class="col-12 col-md-6 col-lg-4">
                <div class="single-popular-course mb-100 wow fadeInUp" data-wow-delay="250ms">
                    <img src="{{$student->profileIMG ?? "https://firebasestorage.googleapis.com/v0/b/elearningapp-30a10.appspot.com/o/undraw_male_avatar_323b%20(1).png"}}" alt="">
                    <!-- Course Content -->
                    <div class="course-content">
                        <h4>Student</h4>
                        <div class="meta d-flex align-items-center">
                            <a href="#">{{$student->firstName}} </a>
                            <span><i class="fa fa-circle" aria-hidden="true"></i></span>
                            <a href="#">{{$student->lastName}}</a>
                        </div>
                        <p> {{$student->bio}}</p>
                    </div>
                    <!-- Seat Rating Fee -->
                    <div class="seat-rating-fee d-flex justify-content-between">
                        <div class="seat-rating h-100 d-flex align-items-center">
                            <div class="seat">
                               Email
                            </div>
                            <div class="rating">
                                <span> {{$student->email}}</span>
                            </div>
                        </div>
                    </div>
            </div>
</div>
@endforeach


        

      
    </div>
</section>
<!-- ##### Popular Course Area End ##### -->




@endsection