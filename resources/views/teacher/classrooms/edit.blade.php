@extends('layouts.app')
@section('title','Edit')
@section('content')
<h3>Edit {{$customer->CustName}}</h3>
<form action="{{ route('customers.update' , ['customer' => $customer]) }}" method="POST" enctype="multipart/form-data">
    //PATCH means you are goin to Update
    @method('PATCH')
    @include('customers.form')
    <input type="submit" class='btn btn-primary'value="Save Customer">
    </form>
        @endsection 