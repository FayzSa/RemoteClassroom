
@extends('layouts.student-app')

@section('title', $test->title)

@section('start')

    <div class="row pt-5"></div>
    <div class="site-section courses-title" id="courses-section">
        <div class="container">
            <div class="row mb-5 justify-content-center">
                <div class="col-7 text-center" data-aos="fade-up" data-aos-delay="">
                    <h2 class="section-title"> {{$test-> getTitle()}}</h2>
                    <h5 class="section-title" data-aos="fade-right" data-aos-delay="" style="font-size: 140%"> {{$test->getDescription()}}</h5>
                </div>
            </div>
        </div>
    </div>


@endsection
@section('content')
    <div class="container-fluid py-3">
        <div class="row ">
            @foreach($test->getFiles() as $file)
                <a href="{{$file}}" data-aos="fade-left" data-aos-delay="" class="btn m-auto btn-primary">download Test</a>
                <div class="row my-3 col-sm-12 col-lg-1"></div>
            @endforeach
            @if($answertestresult == "")
                <a href="{{route('answer.create',['testid' => $test->getTestID()])}}" data-aos="fade-left" data-aos-delay="" class="btn m-auto btn-primary">send answer</a>
            @else
                <a href="{{route('student.classroom.test.answer',['testid' => $test->getTestID(),'answerid'=>$answertestresult])}}" data-aos="fade-left" data-aos-delay="" class="btn m-auto btn-primary">see my answer</a>
            @endif

        </div>
    </div>


@endsection
