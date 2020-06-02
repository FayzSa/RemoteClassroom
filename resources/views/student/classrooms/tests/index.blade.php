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
            <div class="col-2">
                {{$classroom->getClassName()}}
            </div>

            <div class="col-6">
                @foreach($classroom->getTests() as $test)
                    <h3>test name : {{$test->getTitle()}}</h3>
                <a href="{{ route('student.classroom.tests.show',['testid'=>$test->testID , 'classroomid'=> $classroom->getClassroomID() ?? '']) }}"> {{$test->title}}</a>
                @endforeach

                </div>

        </div>
        @endforeach
    </div>
</div>
@endsection
