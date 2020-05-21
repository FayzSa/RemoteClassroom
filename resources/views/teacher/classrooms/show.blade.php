@extends('layouts.app')

@section('title', $classroom->className ?? "")
@section('content')
<div class="row">
    <div class="col-1">
    <a href="{ { route('classroom.edit',['classroom'=>$classroom]) }}" class="btn btn-success px-4">Edit</a>
    </div>
    <div class="col-1">
        <form method="POST" action="{{action('ClassroomsController@destroy',  ['classroom' => $classroom])}}">
           @method('DELETE')
            @csrf
            <input type="submit" value="DELETE" class="btn btn-danger">
            </form>
        </div>
</div>

@endsection