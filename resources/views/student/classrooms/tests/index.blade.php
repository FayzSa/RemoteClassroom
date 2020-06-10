@extends('layouts.student-app')
@section('title','Tests')

@section('content')
<div class="row">
    <div class="col-12">
    <h1>Tests</h1>
    </div>


</div>

<hr>


<div class="row py-2">
    <div class="col-12">
        @foreach ($classroomstests as $classroom)
            <div class="row">
            <div class="card p-0 col-12">
                <div class="card-header text-white text-center font-bold bg-primary" style="font-size: 160%">
                 {{$classroom->getClassName()}}
                </div>
                <div class="card-body">
                    @foreach($classroom->getTests() as $test)
{{--                        <h3>test name : </h3>--}}
{{--                        <a href=""> {{$test->title}}</a>--}}

                        <div class="course bg-white  m-md-2 h-100 align-self-stretch col-sm-12 col-md-4 col-lg-4" style="margin-right: 5px">
                            <figure class="m-0">
                                <a href="{{ route('student.classroom.tests.show',['testid'=>$test->testID , 'classroomid'=> $classroom->getClassroomID() ?? '']) }}"><img src="{{asset('images/img_5.jpg')}}" alt="Image" class="img-fluid"></a>
                            </figure>
                            <div class="course-inner-text py-4 px-4">
                                                    <span class="course-price">delay : {{$test->delay}} jour</span>
                                <h1><a style="font-size: 60%" href="#">{{$test->getTitle()}}</a></h1>
                                <p class="overflow-hidden" >{{$test->getDescription()}} </p>

                                <p></p>
                            </div>
                            <div class="d-flex border-top stats">
                                <div class="py-3 "><span class="icon-users"></span>
                                    {{--                                                             <a href="{{route('student.classroom.show',['classroomID' => $classroom->classroomID])}}" class="btn btn-primary">view courses</a>--}}
                                    <a href="{{ route('student.classroom.tests.show',['testid'=>$test->testID , 'classroomid'=> $classroom->getClassroomID() ?? '']) }}" class="py-3 px-4 btn btn-primary">View Test</a>

                                </div>
                                {{--                    <div title="exams" class="py-3 px-4 w-25 ml-auto border-left"><span class="icon-event_note"></span>{{count($classroom->tests)}}</div>--}}
                            </div>
                        </div>




                    @endforeach
                </div>
            </div>




        </div>
        @endforeach
    </div>
</div>
@endsection
