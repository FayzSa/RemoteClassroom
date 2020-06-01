@extends('layouts.student-app')

@section('title','Add New Test')
@section('content')

<form action="{{route('answer.store',['testid'=> $testid])}}" method="post" enctype="multipart/form-data">
    @include('student.classrooms.tests.answers.form')
    <input type="submit" class='btn btn-primary'value="Add">
        </form>
        @endsection
