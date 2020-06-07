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
   
</div>
<div class="row">
    
        <h1> {{$classroom->className}} </h1>    
     
        <form method="POST" action="{{ route('classrooms.destroy',['classroomID'=>$classroom->classroomID]) }}">
           @method('DELETE')
            @csrf
            <input type="submit" value="DELETE" class="btn btn-danger btn-sm">
            </form>
     </div>





        
          

  <!-- ##### Students ##### -->
  <section class="best-tutors-area section-padding-100">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section-heading">
                    <h3>Classroom Students</h3>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="tutors-slide owl-carousel wow fadeInUp" data-wow-delay="250ms">

                    @foreach ($classroom->students as $student)
                    
                  
                    <!-- Single Tutors Slide -->
                    <div class="single-tutors-slides">
                        <!-- Tutor Thumbnail -->
                        <div class="tutor-thumbnail bg-white">
                        <img src="{{$student->profileIMG ?? "https://firebasestorage.googleapis.com/v0/b/elearningapp-30a10.appspot.com/o/undraw_male_avatar_323b%20(1).png"}}" alt="">
                        </div>
                        <!-- Tutor Information -->
                        <div class="tutor-information text-center">
                            <h5> {{$student->firstName}}  {{$student->lastName}}</h5>
                            <span> {{$student->email}}</span>
                            <p> {{$student->bio}}</p>
                           
                        </div>
                    </div>
                </div>

                @endforeach

            </div>
        </div>
    </div>
</section>
<!-- ##### Best Tutors End ##### -->




@endsection