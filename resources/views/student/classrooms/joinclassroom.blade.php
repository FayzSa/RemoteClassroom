@extends('layouts.student-app')

@section('title','join classroom')
@section('content')
    <form action="{{route('student.classroom.joinclass')}}" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="invitCode">Invite Code</label>
            <input type="text" name="invitCode" placeholder='Invite Code' value='{{old("invitCode") ?? $classroom->invitCode ?? ''}}' class='form-control'>
        </div>
        <p> {{$errors->first('invitCode')}} </p>
        @csrf
        <input type="submit" class='btn btn-primary'value="Join">
    </form>
@endsection