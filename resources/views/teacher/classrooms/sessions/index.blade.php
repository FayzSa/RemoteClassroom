@extends('layouts.app')
@section('title','Sessions Annonce')
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
                    <h2>Up Comming Sessions</h2>
                    
                </div>
            </div>
        </div>
    </div>
</section>



@endsection
@section('content')

 <!-- ##### Upcoming Events Start ##### -->
 <section class="upcoming-events section-padding-100-0">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section-heading">
                    <h3>Upcoming Sessions</h3>
                </div>
            </div>
        </div>
        <div class="row">
            @foreach ($sessions as $session)

            <!-- Single Upcoming Events -->
            <div class="col-12 col-md-6 col-lg-4">
                <div class="single-upcoming-events mb-50 wow fadeInUp" data-wow-delay="750ms">
                    <!-- Events Thumb -->
                    <div class="events-thumb">
                        <img src="{{ asset('clever/img/bg-img/e3.jpg')}}" alt="">
                        <h6 class="event-date">{{$session->hour}}</h6>
                        <p class="event-title">{{$session->subject}}</p>
                    </div>
                    <!-- Date & Fee -->
                    <div class="date-fee d-flex justify-content-between">
                        <div class="date">
                            <p><i class="fa fa-clock"></i> {{$session->date}}</p>
                        </div>
                        <div class="events-fee">
                            <a class='free' href="{{ route('session.edit',['sessionID'=> $session->sessionID ,'classroomID'=> $classroomID]) }}">Edit</a>
                           
                        </div>

                    </div>
                </div>

               
            </div>
             @endforeach
        </div>
    </div>
</section>
<!-- ##### Upcoming Events End ##### -->

@endsection