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

<div class="row">
    <div class="col-12">
    <h1>Requests</h1>    
    </div>


</div>

<hr>    
    

<div class="row py-2">
    <div class="col-12"> 
        @foreach ($students as $student)
        <div class="row">
            <div class="col-4">
                {{$student->firstName}}
            </div>
           <div class="col-4">
            <form action="{{ route('request.add',['classroomID'=> $classroomID , 'studentID'=>$student->userID]) }}" method="POST" enctype="multipart/form-data">
                @method('PATCH')
                @csrf
                <input type="submit" class='btn btn-primary'value="Add to Classroom">
                </form>
            </div>
            <div class="col-4">
                <form action="{{ route('request.remove',['classroomID'=> $classroomID , 'studentID'=>$student->userID]) }}" method="POST" enctype="multipart/form-data">
                    @method('DELETE')
                    @csrf
                    <input type="submit" class='btn btn-danger'value="Refuse">
                    </form>
                </div>
            <div class="col-4">
               
                </div>
        
           
        
        </div>    
        @endforeach
    </div>
</div>
@endsection