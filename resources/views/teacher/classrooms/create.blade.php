@extends('layouts.app')

@section('title','Add New Classroom')
@section('content')
<form action="{{route('classrooms.store')}}" method="post" enctype="multipart/form-data">
    @include('teacher.classrooms.form')
    <input type="submit" class='btn btn-primary'value="Add">
        </form>
        @endsection 