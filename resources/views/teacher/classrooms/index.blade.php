@extends('layouts.app')
@section('title','Classrooms')
@section('start')


<section class="hero-area bg-img bg-overlay-2by5" style="background-image: url({{ asset('clever/img/bg-img/bg1.jpg') }});">
    <div class="container h-100">
        <div class="row h-100 align-items-center">
            <div class="col-12">
                <!-- Hero Content -->
                <div class="hero-content text-center">
                    <h2>Your Classes</h2>
                    
                </div>
            </div>
        </div>
    </div>
</section>



@endsection


@section('content')
<div class="row">
    <div class="col-12">
    <h1> All Classrooms </h1>    
    </div>
</div>

<hr>    
    

  
    <div class="row">
        @foreach ($classrooms as $class)

        
        <div class="col-3 col-sm-6 col-lg-3">
            <div class="single-cool-facts-area text-center mb-100 wow fadeInUp" data-wow-delay="750ms">
                <div class="icon">
                    <img src="{{ asset('clever/img/core-img/star.png')}}" alt="">
                </div>
                <h2><span class="">
                    <a href="{{ route('classrooms.show',['classroomID'=>$class->classroomID]) }}" style="color: #6C63FF"> {{$class->className}}</a>
                </span></h2>
               
            </div>
        </div>
 
        @endforeach
    </div>
@endsection