@extends('layouts.app')
@section('title','Home')
@section('start')


<section class="hero-area bg-img bg-overlay-2by5" style="background-image: url({{ asset('clever/img/bg-img/bg1.jpg') }});">
    <div class="container h-100">
        <div class="row h-100 align-items-center">
            <div class="col-12">
                <!-- Hero Content -->
                <div class="hero-content text-center">
                    <h2>Welcome To Your Classes</h2>
                    
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
@section('content')



<div class="row">
    <div class="col-12">
    <h1> Home </h1>    
    </div>
</div>
<!-- ##### Statistics  ##### -->
<section class="cool-facts-area section-padding-100-0">
    <div class="container">
        <div class="row">
            <!-- Single Cool Facts Area -->
            <div class="col-12 col-sm-6 col-lg-3">
                <div class="single-cool-facts-area text-center mb-100 wow fadeInUp" data-wow-delay="250ms">
                    <div class="icon">
                        <img src="{{ asset('clever/img/core-img/star.png')}}" alt="">
                    </div>
                <h2><span class="counter">{{$classes}}</span></h2>
                    <h5>Classes</h5>
                </div>
            </div>

            <!-- Single Cool Facts Area -->
            <div class="col-12 col-sm-6 col-lg-3">
                <div class="single-cool-facts-area text-center mb-100 wow fadeInUp" data-wow-delay="500ms">
                    <div class="icon">
                        <img src="{{ asset('clever/img/core-img/star.png')}}" alt="">
                    </div>
                    <h2><span class="counter">{{$students}}</span></h2>
                    <h5>Students</h5>
                </div>
            </div>

            <!-- Single Cool Facts Area -->


            <div class="col-12 col-sm-6 col-lg-3">
                <div class="single-cool-facts-area text-center mb-100 wow fadeInUp" data-wow-delay="750ms">
                    <div class="icon">
                        <img src="{{ asset('clever/img/core-img/star.png')}}" alt="">
                    </div>
                    <h2><span class="counter">{{$testes}}</span></h2>
                    <h5>Tests</h5>
                </div>
            </div>

            <!-- Single Cool Facts Area -->
            <div class="col-12 col-sm-6 col-lg-3">
                <div class="single-cool-facts-area text-center mb-100 wow fadeInUp" data-wow-delay="1000ms">
                    <div class="icon">
                        <img src="{{ asset('clever/img/core-img/star.png')}}" alt="">
                    </div>
                    <h2><span class="counter">{{$courses}}</span></h2>
                    <h5>Available Courses</h5>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- ##### Cool Facts Area End ##### -->


@endsection