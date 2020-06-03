@extends('layouts.student-app')

@section('title', "Annonce")
@section('content')

    <h3 class='text-muted'>Session: {{$session->sessionID}}</h3>
    <div class="row">
        <div class="col-1">
            subject : {{$session->subject}}
        </div>
        <div class="col-1">

            <a href="{{ route('student.classroom.show',['classroomID'=>$classroom->classroomID]) }}">visit the classroom </a>
        </div>
    </div>

@endsection
