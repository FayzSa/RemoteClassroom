@extends('layouts.student-app')
@section('title','Sessions Annonce')

@section('content')
    <div class="row">
        <div class="col-12">
            <h1>Session</h1>
        </div>


    </div>

    <hr>


    <div class="row py-2">
        <div class="col-12">
            @foreach ($sessions as $session)
                <div class="row">
                    <div class="col-2">
                        {{$session->sessionID}}
                    </div>

                    <div class="col-6">
                        <a href="{{ route('student.classroom.session',['sessionid'=>$session->sessionID , 'classroomid'=> $classroomid ?? $session->classroomID]) }}"> {{$session->subject}}</a>

                    </div>

                </div>
            @endforeach
        </div>
    </div>
@endsection
