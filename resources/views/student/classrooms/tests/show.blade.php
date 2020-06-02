@extends('layouts.student-app')

@section('title', $test->title)
@section('content')


<div class="row">
    <h4>classroom name
    <a href=" {{route('student.classroom.show',['classroomID' =>$classroom->getClassroomID()])}}" >  {{$classroom->getClassName()}}</a>
    </h4>
</div>
<div class="row">
    <h3 class='text-muted'>Test : {{$test->title}}</h3>
    <div class="col-1">
        @foreach($test->getFiles() as $file)
            <a href="{{$file}}" class="btn btn-success">download</a>
        @endforeach
        @if($answertestresult == "")
            <a href="{{route('answer.create',['testid' => $test->getTestID()])}}" class="btn btn-success">send answer</a>
        @else
                <a href="{{route('student.classroom.test.answer',['testid' => $test->getTestID(),'answerid'=>$answertestresult])}}" class="btn btn-success">see my answer</a>
                    @endif
    </div>

@endsection
