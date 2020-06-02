@extends('layouts.app')

@section('title', "Annonce")
@section('content')

<h3 class='text-muted'>Session: {{$session->sessionID}}</h3> 
<div class="row"> 
    <div class="col-1">
    <a href="{{ route('session.edit',['sessionID'=> $session->sessionID ,'classroomID'=> $classroomID]) }}" class="btn btn-success px-4">Edit</a>
    
</div>
    <div class="col-1">

        <form method="POST" action="{{ route('session.destroy',['sessionID'=> $session->sessionID ,'classroomID'=> $classroomID]) }}">
           @method('DELETE')
            @csrf
            <input type="submit" value="DELETE" class="btn btn-danger">
            </form>
            <a href="{ { route('classrooms.show',['classroomID'=>$classroom->classroomID]) }}"> {{$session->subject}}</a>
        </div>
</div>

@endsection