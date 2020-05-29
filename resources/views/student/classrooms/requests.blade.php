@extends('layouts.student-app')

@section('title')
    your requests
@endsection
@section('content')
    @foreach($classrooms as $classroom)
        <div class="card" style="width:400px">
            <div class="card-body">
                <h4 class="card-title">{{$classroom->className}}</h4><br>
                <p class="card-text">{{count($classroom->courses)}}</p>
                <button disabled="disabled" class="btn btn-primary">view courses</button>
             </div>
        </div>
    @endforeach
 @endsection