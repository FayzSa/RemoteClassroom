@extends('layouts.app')

@section('title', $test->title)
@section('content')

<h3 class='text-muted'>Test : {{$test->title}}</h3> 
<div class="row"> 
    <div class="col-1">
    <a href="{{ route('test.edit',['testID'=> $test->testID ,'classroomID'=> $classroomID]) }}" class="btn btn-success px-4">Edit</a>
    
</div>
    <div class="col-1">

        <form method="POST" action="{{ route('test.destroy',['testID'=> $test->testID ,'classroomID'=> $classroomID]) }}">
           @method('DELETE')
            @csrf
            <input type="submit" value="DELETE" class="btn btn-danger">
            </form>
            <a href="{ { route('classrooms.show',['classroomID'=>$classroom->classroomID]) }}"> {{$test->title}}</a>
        </div>
</div>

@endsection