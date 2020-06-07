@extends('layouts.app')
@section('title','Edit Annonce')
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
                    <h2>Edit Your Session </h2>
                    
                </div>
            </div>
        </div>
    </div>
</section>



@endsection
@section('content')
<h3>Edit Annonce</h3>
<form action="{{ route('session.update',['sessionID'=> $session->sessionID ,'classroomID'=> $classroomID]) }}" method="POST" enctype="multipart/form-data">
    @method('PATCH')
    @include('teacher.classrooms.sessions.form')
    <input type="submit" class='btn btn-primary'value="Update">
    </form>
    @endsection 