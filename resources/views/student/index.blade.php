@extends('layouts.student-app')
@section('title')
    student
@endsection
@section('start')
    <div class="intro-section" id="home-section">

        <div class="slide-1" style="background-image: url('{{asset('images/hero_1.jpg')}}')" data-stellar-background-ratio="0.5">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-12">
                        <div class="row align-items-center">
                            <div class="col-lg-6 mb-4">
                                <h1 data-aos="fade-up" data-aos-delay="100">Join any classroom you want</h1>
                                <p data-aos="fade-up" data-aos-delay="200" class="mb-4">by using the invite cod that your teacher gives you :)</p>
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
                    <h2 class="section-title"> Your classrooms</h2>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('content')

{{--    <div class="row pt-5">--}}
{{--        <a class="btn btn-primary mx-auto col-6"  href="#home-section">join Class Room </a>--}}
{{--    </div>--}}
<div class="container">
    <div class="row pt-3 d-flex justify-content-center" data-aos="fade-up" data-aos-delay="">



        @foreach($classrooms as $classroom)
            <div class="course m-1 bg-white  mx-auto  h-100 col-sm-12 col-md-4 col-lg-3" style="">
                <div class="container p-0">
                    <figure class="">
                        <a href="{{route('student.classroom.show',['classroomID' => $classroom->classroomID])}}"><img src="{{asset('images/img_5.jpg')}}" alt="Image" class="img-fluid"></a>
                    </figure>
                    <div class="course-inner-text  px-4">
                        <span class="course-price">join live</span>
                        <h1><a style="font-size: 60%" href="#">{{$classroom->className}}</a></h1>
                        <div class="meta"><span class="icon-clock-o"></span>{{count($classroom->courses)}} Courses</div>
                        <div class="meta"><span class="icon-class"></span>{{count($classroom->tests)}} Exam</div>

                        <p></p>
                    </div>
                    <div class="border-top stats">
                        <div class="py-3 row  d-flex justify-content-between"><span class="icon-users"></span>
                            {{--                                                             <a href="{{route('student.classroom.show',['classroomID' => $classroom->classroomID])}}" class="btn btn-primary">view courses</a>--}}
                            <a href="{{route('student.classroom.tests',['classroomid' => $classroom->classroomID])}}" class=" col-5 float-right btn-outline-primary py-1 ">Exams</a>
                            <a href="{{route('student.classroom.sessions',['classroomid' => $classroom->classroomID])}}" class="col-5  float-left text-center  btn-outline-primary py-1">Announces</a>
                            <button onclick="exit_classroom('{{$classroom->classroomID}}')" class="btn position-absolute text-center p-0 py-1 btn-danger text-center col-3" style="bottom:100px;right: 20px;">exit</button>
                        </div>
                        {{--                    <div title="exams" class="py-3 px-4 w-25 ml-auto border-left"><span class="icon-event_note"></span>{{count($classroom->tests)}}</div>--}}
                    </div>
                </div>

            </div>



            {{--         <div class="card" style="width:400px">--}}
            {{--             <div class="card-body">--}}
            {{--                 <h4 class="card-title"></h4><br>--}}
            {{--                 <p class="card-text">courses :   tests : {{count($classroom->tests)}} </p>--}}
            {{--                 <button disabled="disabled" class="btn btn-success">join live</button>--}}
            {{--                 <button onclick="exit_classroom('{{$classroom->classroomID}}')" class="btn btn-primary">exit clasroom</button>--}}
            {{--                 <a href="{{route('student.classroom.show',['classroomID' => $classroom->classroomID])}}" class="btn btn-primary">view courses</a>--}}
            {{--                 <a href="{{route('student.classroom.tests',['classroomid' => $classroom->classroomID])}}" class="btn mt-2 btn-primary">view tests</a>--}}
            {{--                 <a href="{{route('student.classroom.sessions',['classroomid' => $classroom->classroomID])}}" class="btn mt-2 btn-primary">view sessionsssssss</a>--}}

            {{--             </div>--}}
            {{--         </div>--}}
        @endforeach



    </div>


</div>

@endsection
@section('script')
    function exit_classroom(classroom_id){
    var confirm = window.confirm("do you really want to exit the classroom ? ");
    var url = "http://127.0.0.1:8000/student/classroom/exit/"+classroom_id;
    if(confirm){
    window.location = url;
    }
    }
    @endsection
