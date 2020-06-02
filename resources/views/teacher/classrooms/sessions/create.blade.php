@extends('layouts.app')

@section('title','Annonce New Session')
@section('content')

<form action="{{ route('sessions.store',['classroomID'=>$classroomID]) }}" method="post" enctype="multipart/form-data">
    @include('teacher.classrooms.sessions.form')
    <input type="submit" class='btn btn-primary'value="Add">
        </form>
        @endsection 