@extends('layouts.app')

@section('title','Add New Classroom')

@section('start')


<section class="hero-area bg-img bg-overlay-2by5" style="background-image: url({{ asset('clever/img/bg-img/bg1.jpg') }});">
    <div class="container h-100">
        <div class="row h-100 align-items-center">
            <div class="col-12">
                <!-- Hero Content -->
                <div class="hero-content text-center">
                    <h2>Create New Classroom is Easy</h2>
                    
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
@section('content')
<div class="row">
    <div class="col-12">
    <h1> Create New Classroom </h1>    
    </div>
</div>

<form action="{{route('classrooms.store')}}" method="post" enctype="multipart/form-data">
    @include('teacher.classrooms.form')
    <input type="submit" class='btn btn-primary'value="Create">
        </form>
        @endsection 