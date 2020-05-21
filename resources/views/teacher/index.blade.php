@extends('layouts.app')
@section('title','Home')

@section('content')
<div class="row">
    <div class="col-12">
    <h1>Home </h1>    
    </div>

<a href="{ { route('customers.create') }}" class="a color-primary">Add new Classroom</a>


</div>

<hr>    
    

<div class="row py-2">
    <div class="col-12 d-flex justify-content-center"> 
       
    </div>
</div>
@endsection