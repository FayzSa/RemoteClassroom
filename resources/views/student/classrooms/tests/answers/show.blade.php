@extends('layouts.student-app')

@section('title', $answer->getTitle() ?? "")
@section('content')
    <h3 class='text-muted'>title : {{$answer->title}}</h3>
    <br>
<h3 class='text-muted'>description : {{$answer->description}}</h3>
<div class="row">
    <div class="col-1">
{{--    <a href="{{ route('course.edit',['courseID'=> $course->course_id ,'classroomID'=> $classroomID]) }}" class="btn btn-success px-4">Edit</a>--}}

</div>
    <h3>download my answer <a href="{{end($answer->filesanswer)}}" class="btn btn-success">download file</a></h3>
    <br>
    <a href="{{route('answer.edit',['testid' => $testid,'answerid'=>$answer->answerID])}}" class="ml-5 btn btn-success">update my answer</a>

    <form method="POST" action="{{ route('answer.destroy',['testid'=> $testid,'answerid'=> $answer->answerID]) }}">
        @method('DELETE')
        @csrf
        <input type="submit" value="DELETE my answer" class="btn btn-danger">
    </form>
</div>

@endsection
