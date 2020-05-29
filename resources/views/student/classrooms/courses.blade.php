@extends('layouts.student-app')

@section('title')
    classroom name
@endsection

@section('content')
    @foreach($courses as $course)
        <div class="card" style="width:400px">
            <div class="card-body">
                <h4 class="card-title">{{$course->getName()}}</h4><br>
                <p class="card-text">{{$course->getDescription()}}</p>
                <a href="{{route('student.classroom.course.show',['courseID'=>$course->getCourseId()])}}" class="btn btn-primary">view course</a>
            </div>
        </div>
    @endforeach
@endsection