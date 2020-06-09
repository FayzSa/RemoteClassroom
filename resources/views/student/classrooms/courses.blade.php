@extends('layouts.student-app')

@section('title')
    {{$classroom-> getClassName()}}
@endsection

@section('start')
    <div class="row pt-5"></div>
    <div class="site-section courses-title" id="courses-section">
        <div class="container">
            <div class="row mb-5 justify-content-center">
                <div class="col-7 text-center" data-aos="fade-up" data-aos-delay="">
                    <h2 class="section-title"> {{$classroom-> getClassName()}}</h2>
                </div>
            </div>
        </div>
    </div>
    @endsection
@section('content')
    <div class="row pt-5">
    @foreach($courses as $course)
{{--        <div class="card" style="width:400px">--}}
{{--            <div class="card-body">--}}
{{--                <h4 class="card-title">{{$course->getName()}}</h4><br>--}}
{{--                <p class="card-text">{{$course->getDescription()}}</p>--}}
{{--                <a href="{{route('student.classroom.course.show',['courseID'=>$course->getCourseId()])}}" class="btn btn-primary">view course</a>--}}
{{--            </div>--}}
{{--        </div>--}}



            <div class="course bg-white  m-md-2 h-100 align-self-stretch col-sm-12 col-md-4 col-lg-4" style="margin-right: 5px">
                <figure class="m-0">
                    <a href="{{route('student.classroom.course.show',['courseID'=>$course->getCourseId()])}}"><img src="{{asset('images/img_5.jpg')}}" alt="Image" class="img-fluid"></a>
                </figure>
                <div class="course-inner-text py-4 px-4">
                    {{--                    <span class="course-price">$20</span>--}}
                    <h1><a style="font-size: 60%" href="#">{{$course->getName()}}</a></h1>
                    <p class="overflow-hidden" >{{$course->getDescription()}} </p>

                    <p></p>
                </div>
                <div class="d-flex border-top stats">
                    <div class="py-3 "><span class="icon-users"></span>
                        {{--                                                             <a href="{{route('student.classroom.show',['classroomID' => $classroom->classroomID])}}" class="btn btn-primary">view courses</a>--}}
                        <a href="{{route('student.classroom.course.show',['courseID'=>$course->getCourseId()])}}" class="py-3 px-4 btn btn-primary ">View course</a>

                    </div>
                    {{--                    <div title="exams" class="py-3 px-4 w-25 ml-auto border-left"><span class="icon-event_note"></span>{{count($classroom->tests)}}</div>--}}
                </div>
            </div>



    @endforeach
    </div>
@endsection
