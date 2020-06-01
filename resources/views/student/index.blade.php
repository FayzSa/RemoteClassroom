@extends('layouts.student-app')
@section('title')
    student
@endsection

@section('content')

     @foreach($classrooms as $classroom)
         <div class="card" style="width:400px">
             <div class="card-body">
                 <h4 class="card-title">{{$classroom->className}}</h4><br>
                 <p class="card-text">courses :  {{count($classroom->courses)}} tests : {{count($classroom->tests)}} </p>
                 <button disabled="disabled" class="btn btn-success">join live</button>
                 <button onclick="exit_classroom('{{$classroom->classroomID}}')" class="btn btn-primary">exit clasroom</button>
                 <a href="{{route('student.classroom.show',['classroomID' => $classroom->classroomID])}}" class="btn btn-primary">view courses</a>
                 <a href="{{route('student.classroom.tests',['classroomid' => $classroom->classroomID])}}" class="btn btn-primary">view tests</a>

             </div>
         </div>
     @endforeach
@endsection
@section('script')
    function exit_classroom(classroom_id){
    var confirm = window.confirm("do you really want to exit the classroom ? ");
    var url = "http://127.0.0.1:8000/student/classroom/exit/"+classroom_id;
    if(confirm){
    window.location = url;
    }
    }
    @endsection
