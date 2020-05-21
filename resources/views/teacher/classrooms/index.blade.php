@extends('layouts.app')
@section('title','Classrooms')

@section('content')
<div class="row">
    <div class="col-12">
    <h1>Classrooms </h1>    
    </div>

<a href="{{ url('/teacher/classrooms/create') }}" class="a color-primary">Add new Classroom</a>


</div>

<hr>    
    


        <h3 class='text-muted'>Classrooms :</h3>    
    
        @foreach ($classrooms as $class)
        <div class="row">
            <div class="col-2">
                {{$class->classroomID}}
            </div>
        
            <div class="col-4">
            <a href="{{url('/teacher/classrooms/show')}}/{{$class->classroomID }}"> {{$class->className}}</a>
                </div>
        
           
        
        </div>    
        @endforeach
    
@endsection