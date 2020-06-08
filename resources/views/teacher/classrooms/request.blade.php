@extends('layouts.app')
@section('title','Requests')
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
                    <h2>Requests</h2>
                    
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
                    <h3>Requests</h3>
                </div>
            </div>
        </div>
        <div class="row">
            @foreach ($students as $student)

            <!-- Single Upcoming Events -->
            <div class="col-12 col-md-6 col-lg-4">
                <div class="single-upcoming-events mb-50 wow fadeInUp" data-wow-delay="750ms">
                    <!-- Events Thumb -->
                    <div class="events-thumb">
                        <img src="{{$student->profileIMG ?? "https://firebasestorage.googleapis.com/v0/b/elearningapp-30a10.appspot.com/o/undraw_male_avatar_323b%20(1).png"}}" alt="">
                        <h4 class="event-date">{{$student->firstName}} {{$student->lastName}}</h4>
                        <p class="event-title">{{$student->bio}}</p>
                    </div>
                    <!-- Date & Fee -->
                    <div class="date-fee d-flex justify-content-start">
                        <div class="date">
                            <p><i class="fa fa-clock"></i> {{$student->email}}</p>
                        </div>
                    </div>
                        <div class="events-fee">
                            <form class=" mb-2" action="{{ route('request.add',['classroomID'=> $classroomID , 'studentID'=>$student->userID]) }}" method="POST" enctype="multipart/form-data">
                                @method('PATCH')
                                @csrf
                                <button type="submit" class='col-12 btn btn-primary btn-sm'value="">Add to Classroom</button>
                                </form>
                                 
                                <form class="" action="{{ route('request.remove',['classroomID'=> $classroomID , 'studentID'=>$student->userID]) }}" method="POST" enctype="multipart/form-data">
                                    @method('DELETE')
                                    @csrf
                                    <button type="submit" class='col-12 btn btn-danger btn-sm'value="">Refuse</button>
                                    </form>
                        </div>

                    
                </div>

               
            </div>
             @endforeach
        </div>
    </div>
</section>
<!-- ##### Upcoming Events End ##### -->


@endsection