@extends('layouts.student-app')

@section('title','update my answer')
@section('start')

    <div class="row pt-5"></div>
    <div class="site-section courses-title" id="courses-section">
        <div class="container">
            <div class="row mb-5 justify-content-center">
                <div class="col-7 text-center" data-aos="fade-up" data-aos-delay="">
                    <h2 class="section-title">send answer</h2>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('content')
    <div class="row pb-5 px-0 mh-100 bg-primary">
        <form data-aos="fade-up" data-aos-delay="" action="{{ route('answer.update',['testid'=> $testid ,'answerid'=> $answer->answerID]) }}" class="col-lg-5 mx-auto" method="post" enctype="multipart/form-data">
            @include('student.classrooms.tests.answers.form')
            <input type="submit" class='btn col-4 m-auto d-flex justify-content-center btn-light'value="Add">
        </form>
    </div>

@endsection
@section('script')
    $(document).ready(function(){

    $('input[type="file"]').change(function(e){

    var fileName = e.target.files[0].name;
    $("#downloadfile").html(fileName);
    });

    });

@endsection

