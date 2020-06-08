@extends('layouts.app')

@section('title','Create Session')
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
                    <h2>Create Meeting</h2>
                    
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
@section('content')
<h3>Create Meeting</h3>
<div class="container ">
    <form method="post" action="{{route('live.create',['classroomID'=>$classroomID])}}">
        @csrf
      
        
       
        <div class="form-group">
            <label for="meetingname">Meeting Name</label>
            <input type="text" class="form-control" name="meetingname" id="meetingname" aria-describedby="meetingname" placeholder="Enter Name of Meeting">
        </div>
        <div class="form-group">
            <label for="welcomemessage">Welcome Message What You Want to Say to The Student in The Live When They Join it </label>
            <input type="text" class="form-control" name="welcomemessage" id="welcomemessage" aria-describedby="welcomemessage" placeholder="Enter The Welcome Message ">
            

        </div>
        <button type="submit" class="btn btn-primary">Start</button>
    </form>
</div>
@endsection 