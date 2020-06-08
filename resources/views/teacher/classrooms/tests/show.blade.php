@extends('layouts.app')

@section('title', $test->title)
@section('classnav')
@include('teacher.classrooms.navClassroom')
@endsection

@section('start')


<section class="hero-area bg-img bg-overlay-2by5" style="background-image: url({{ asset('clever/img/bg-img/bg1.jpg') }});">
    <div class="container h-100">
        <div class="row h-100 align-items-center">
            <div class="col-12">
                <!-- Hero Content -->
                <div class="hero-content text-center">
                    <h2>Answers of The Test</h2>
                    
                </div>
            </div>
        </div>
    </div>
</section>



@endsection

@section('content')

        <p></p>
        <h3 class='text-muted'>Answers : </h3> 
        <br>







 <!-- ##### Popular Course Area Start ##### -->
 <section class="popular-courses-area section-padding-100">
    <div class="container">
        <div class="row">

            @foreach ($test->answers as $answer)
            <!-- Single Popular Course -->
            <div class="col-12 col-md-6 col-lg-4">
                <div class="single-popular-course mb-100 wow fadeInUp" data-wow-delay="250ms">
                    <img src="https://firebasestorage.googleapis.com/v0/b/elearningapp-30a10.appspot.com/o/undraw_online_test_gba7.png?alt=media&token=1f272de0-d4a6-4108-b7f3-484cd59da08c" alt="">
                    <!-- Course Content -->
                    <div class="course-content">
                        <h4> {{$answer->title}}</h4>
                        <div class="meta d-flex align-items-center">
                            <a href="#">Student</a>
                            <span><i class="fa fa-circle" aria-hidden="true"></i></span>
                            <a href="#"> {{$answer->studentname}}</a>
                        </div>
                        <p> {{$answer->description}}</p>
                    </div>
                    <!-- Seat Rating Fee -->
                    <div class="seat-rating-fee d-flex justify-content-between">
                        <div class="seat-rating h-100 d-flex align-items-center">
                            <div class="seat">
                               Answer Date
                            </div>
                            <div class="rating">
                               {{$answer->answerdate}}
                            </div>
                        </div>

                        <div class="course-fee h-100">
                        <a href="#" type="button" class="free" data-toggle="modal" data-target="#{{$answer->answerID}}">
                            Files
                        </a>
                    </div>

                    </div>
            </div>

     

@endforeach



        </div>

      
    </div>
</section>

@foreach ($test->answers as $answer)
<!-- Modal -->
<div class="modal fade" id="{{$answer->answerID}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">{{$answer->studentname}}'s Files of The Answer</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          @foreach($answer->filesanswer as $f)
        <a class="text-primary col-3" href="{{$f}}">Open File</a>
          @endforeach
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
         
        </div>
      </div>
    </div>
  </div> 
  @endforeach
<!-- ##### Popular Course Area End ##### -->


@endsection