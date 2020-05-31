@extends('layouts.app')
@section('title','Tests')

@section('content')
<div class="row">
    <div class="col-12">
    <h1>Tests</h1>    
    </div>


</div>

<hr>    
    

<div class="row py-2">
    <div class="col-12"> 
        @foreach ($tests as $test)
        <div class="row">
            <div class="col-2">
                {{$test->testID}}
            </div>
        
            <div class="col-6">
                <a href="{{ route('classroom.tests.show',['testID'=>$test->testID , 'classroomID'=> $classroomID ?? '']) }}"> {{$test->title}}</a>

              
                </div>
        
           
        
        </div>    
        @endforeach
    </div>
</div>
@endsection