@extends('layouts.student-app')

@section('title')
    your requests
@endsection

@section('start')
    <div class="intro-section" id="home-section">

        <div class="slide-1" style="background-image: url('{{asset('images/hero_1.jpg')}}')" data-stellar-background-ratio="0.5">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-12">
                        <div class="row align-items-center">
                            <div class="col-lg-6 mb-4">
                                <h1 data-aos="fade-up" data-aos-delay="100">Join more classes by send requests to there owners</h1>
                                <p data-aos="fade-up" data-aos-delay="200" class="mb-4">using the invite cod that your teacher gives you:)</p>
                            </div>

                            <div class="col-lg-5 ml-auto" data-aos="fade-up" data-aos-delay="500">
                                <form action="{{route('student.classroom.joinclass')}}" method="post" enctype="multipart/form-data" class="form-box">
                                    <h3 class="h4 text-black mb-4">Invite code</h3>
                                    <div class="form-group">
                                        {{--                                        <label for="invitCode">Invite Code</label>--}}
                                        <input type="text" name="invitCode" placeholder='Invite Code' value='{{old("invitCode") ?? $classroom->invitCode ?? ''}}' class='form-control'>
                                    </div>
                                    <p> {{$errors->first('invitCode')}} </p>
                                    @csrf
                                    <input type="submit" class='btn btn-primary ml-3' value="Send request to join the classroom">
                                </form>

                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>


    <div class="site-section courses-title" id="courses-section">
        <div class="container">
            <div class="row mb-5 justify-content-center">
                <div class="col-7 text-center" data-aos="fade-up" data-aos-delay="">
                    <h2 class="section-title"> Your Requests</h2>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('content')
    @foreach($classrooms as $classroom)
        <div class="course bg-white  m-md-2 h-100 align-self-stretch col-sm-12 col-md-4 col-lg-4" style="margin-right: 5px">
            <figure class="m-0">
              <img src="{{asset('images/img_5.jpg')}}" alt="Image" class="img-fluid">
            </figure>
            <div class="course-inner-text py-4 px-4">
                <span class="course-price">Pending.....</span>
                <h1><a style="font-size: 60%" href="#">{{$classroom->className}}</a></h1>
                <div class="meta"><span class="icon-clock-o"></span>{{count($classroom->courses)}} Courses</div>
                <div class="meta"><span class="icon-class"></span>{{count($classroom->tests)}} Exam</div>

                <p></p>
            </div>
            <div class="d-flex border-top stats">
                <div class="py-3 "><span class="icon-users"></span>
                    {{--                                                             <a href="{{route('student.classroom.show',['classroomID' => $classroom->classroomID])}}" class="btn btn-primary">view courses</a>--}}
                </div>
                {{--                    <div title="exams" class="py-3 px-4 w-25 ml-auto border-left"><span class="icon-event_note"></span>{{count($classroom->tests)}}</div>--}}
            </div>
        </div>
    @endforeach
 @endsection
