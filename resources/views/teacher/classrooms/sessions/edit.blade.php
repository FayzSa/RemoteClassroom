@extends('layouts.app')
@section('title','Edit Annonce')
@section('content')
<h3>Edit Annonce</h3>
<form action="{{ route('session.update',['sessionID'=> $session->sessionID ,'classroomID'=> $classroomID]) }}" method="POST" enctype="multipart/form-data">
    @method('PATCH')
    @include('teacher.classrooms.sessions.form')
    <input type="submit" class='btn btn-primary'value="Update">
    </form>
    @endsection 