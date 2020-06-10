@extends('layouts.student-app')

@section('title', $answer->getTitle() ?? "answer")
@section('start')

    <div class="row pt-5"></div>
    <div class="site-section courses-title" id="courses-section">
        <div class="container">
            <div class="row mb-5 justify-content-center">
                <div class="col-7 text-center" data-aos="fade-up" data-aos-delay="">
                    <h2 class="section-title"> {{$answer->title}}</h2>
                    <h5 class="text-center font-bold text-white">{{$answer->description}}</h5>
                </div>
            </div>
        </div>
    </div>

    @endsection
@section('content')
<div class="container">
    <div class="row justify-content-center py-3">
        <a href="{{end($answer->filesanswer)}}" data-aos="fade-right" data-aos-delay="" class="btn d-flex m-2 btn-primary">download my answer</a>
        <br>
        <a href="{{route('answer.edit',['testid' => $testid,'answerid'=>$answer->answerID])}}" data-aos="fade-up" data-aos-duration="700" data-aos-delay="" class="btn m-2 btn-light btn-outline-primary">update my answer</a>
        <form method="POST" action="{{ route('answer.destroy',['testid'=> $testid,'answerid'=> $answer->answerID]) }}">
            @method('DELETE')
            @csrf
            <input type="submit" value="DELETE my answer" data-aos="fade-left" data-aos-delay="" class="btn m-2 btn-danger">
        </form>
    </div>
</div>

{{--    <a href="{{ route('course.edit',['courseID'=> $course->course_id ,'classroomID'=> $classroomID]) }}" class="btn btn-success px-4">Edit</a>--}}





@endsection
