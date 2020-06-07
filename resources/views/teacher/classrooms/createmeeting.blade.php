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
    <form method="post" action="{{route('live.create')}}">
        @csrf
        <div class="form-group">
            <label for="lastname">name dans le live</label>
            <input type="text" class="form-control" name="username" id="lastname" aria-describedby="emailHelp" placeholder="Enter your last name">
        </div>
        <div class="form-group">
            <label for="password">the teacher password</label>
            <input type="text" class="form-control" name="password" id="password" aria-describedby="password" placeholder="Enter teacher password">
            <small id="password" class="form-text text-muted">any teacher we wnt to join the live as teacher will use that password</small>
        </div>
        <div class="form-group">
            <label for="attendedpassword">the student password</label>
            <input type="text" class="form-control" name="attendedpassword" id="attendedpassword" aria-describedby="emailHelp" placeholder="Enter student password">
            <small id="attendedpassword" class="form-text text-muted">any student we want to join the live as student will use that password</small>
        </div>
        <div class="form-group">
            <label for="meeting">the meeting id later we will use invite code</label>
            <input type="text" class="form-control" name="meeting" id="meeting" aria-describedby="emailHelp" placeholder="Enter the meeting id">
            <small id="meeting" class="form-text text-muted">any one want to join the live will need these meeting id</small>
        </div>
        <div class="form-group">
            <label for="meetingname">the name of the meeting | the course name</label>
            <input type="text" class="form-control" name="meetingname" id="meetingname" aria-describedby="meetingname" placeholder="Enter name of meeting">
            <small id="meetingname" class="form-text text-muted">the name of the course for exemple english</small>
        </div>
        <div class="form-group">
            <label for="welcomemessage">welcome message what you want to say to the student in the live when they join it </label>
            <input type="text" class="form-control" name="welcomemessage" id="welcomemessage" aria-describedby="welcomemessage" placeholder="Enter the welcome message ">
            <small id="welcomemessage" class="form-text text-muted">the welcome message</small>

        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
@endsection 