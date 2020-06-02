@extends('layouts.student-app')
@section('title','Edit')
@section('content')
<h3>Edit {{$answer->title}}</h3>
<form action="{{ route('answer.update',['testid'=> $testid ,'answerid'=> $answer->answerID]) }}" method="POST" enctype="multipart/form-data">
    @method('PATCH')
    @include('student.classrooms.tests.answers.form')
    <input type="submit" class='btn btn-primary'value="Update">
    </form>
    @endsection
