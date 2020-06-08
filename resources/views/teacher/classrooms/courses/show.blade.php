@extends('layouts.app')

@section('title', $course->name ?? "")
@section('content')
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
                <h2>{{$course->name}} Course</h2>
                    
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

@section('content')
<div class="row">
    <div class="col-12">
    <h1> Course </h1>    
    </div>
</div>

<hr>  





  
  <div class="site-section">
    <div class="container">
      <div class="row">
        <div class="col-lg-8 mb-5">

          <div class="mb-5">
            <h3 class="text-black">{{$course->name}}</h3>
            <p class="mb-4">
            </p>
                <p>
                {{$course->description}}
                </p>
                <p class="mb-4">
                    <strong class="text-black mr-3 mb-1">Files: </strong>

          @foreach ($course->files as $file)
                <a href="{{$file}}" target="_blank" rel="noopener noreferrer" class="col-3 text-primary">Open</a>
          @endforeach      
                  </p>
                  <div class="row">
                      <div class="col-6">
                        <a href="{{ route('course.edit',['courseID'=> $course->course_id ,'classroomID'=> $classroomID]) }}" class="btn btn-primary px-4">Edit</a>
   
                      </div>
                      <div class="col-6">
                        <form method="POST" action="{{ route('course.destroy',['courseID'=> $course->course_id ,'classroomID'=> $classroomID]) }}">
                            @method('DELETE')
                             @csrf
                             <input type="submit" value="Delete" class="btn btn-danger">
                             </form>
                    </div>
                  </div>
          <div class="pt-5">
            <h3 class="mb-5">{{sizeof($course->comments)}} Comments</h3>
            <ul class="comment-list">
@foreach ($course->comments as $comment)
<li class="comment">
    <div class="vcard bio">
      <img src="{{$comment->owenrPic}}" alt="Image">
    </div>
    <div class="comment-body">
    <h3>{{$comment->owenrName}}</h3>
      <div class="meta">{{$comment->dateComment}}</div>
      <p>{{$comment->body}}</p>
     
    </div>
  </li>
@endforeach

             


            
                    </ul>
                 
            
            <!-- END comment-list -->
           
          </div>
        </div>
@endsection