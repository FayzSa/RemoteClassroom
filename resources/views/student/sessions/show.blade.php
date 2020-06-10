@extends('layouts.student-app')
@section('style')
    <link rel="stylesheet" href="{{asset('css/flipdown.css')}}">
    @endsection
@section('title', "Annonce")
@section('start')
    <div class="row pt-5"></div>
    <div class="site-section courses-title" id="courses-section">
        <div class="container">
            <div class="row mb-5 justify-content-center">
                <div class="col-7 text-center" data-aos="fade-up" data-aos-delay="">
                    <h2 class="section-title">{{$session->date}}</h2>

{{--                    <div id="flipdown" class="flipdown mt-5 section-sub-title"></div>--}}

                </div>
            </div>

        </div>

    </div>
    </div>
@endsection
@section('content')
<div class="container">
    <div class="row">
        <div class="col-12 pt-3">
            <a class="col-lg-4 col-sm-12 m-auto d-flex justify-content-center btn btn-primary" data-aos="fade-right" data-aos-delay="" href="{{ route('student.classroom.show',['classroomID'=>$classroom->classroomID]) }}">visit the classroom </a>

        </div>
    </div>
</div>

    <div class="row mt-30">
        <div class="col-12">
            <p class="text-center font-bold">
                subject : {{$session->subject}}
            </p>

        </div>
        <div class="col-1">

        </div>
    </div>

@endsection

@section('script')


@endsection
