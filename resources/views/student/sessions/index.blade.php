@extends('layouts.student-app')
@section('title','Sessions Annonce')
@section('style')
    <link rel="stylesheet" href="{{asset('css/announces.css')}}">
@endsection
@section('start')
    <div class="row pt-5"></div>
    <div class="site-section courses-title" id="courses-section">
        <div class="container">
            <div class="row mb-5 justify-content-center">
                <div class="col-7 text-center" data-aos="fade-up" data-aos-delay="">
                    <h2 class="section-title"> Announces</h2>
                    <h5 class="section-title" data-aos="fade-right" data-aos-delay="" style="font-size: 140%"> </h5>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('content')
{{--    <div class="row">--}}
{{--        <div class="col-12">--}}
{{--            <h1>Session</h1>--}}
{{--        </div>--}}


{{--    </div>--}}

{{--    <hr>--}}


{{--    <div class="row py-2">--}}
{{--        <div class="col-12">--}}
{{--            @foreach ($sessions as $session)--}}
{{--                <div class="row">--}}
{{--                    <div class="col-2">--}}
{{--                        {{$session->sessionID}}--}}
{{--                    </div>--}}

{{--                    <div class="col-6">--}}
{{--                        <a href="{{ route('student.classroom.session',['sessionid'=>$session->sessionID , 'classroomid'=> $classroomid ?? $session->classroomID]) }}"> {{$session->subject}}</a>--}}

{{--                    </div>--}}

{{--                </div>--}}
{{--            @endforeach--}}
{{--        </div>--}}
{{--    </div>--}}

<!------ Include the above in your HEAD tag ---------->
<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <ul class="timeline">
                @for ($i = 0; $i < count($sessions); $i++)

                     @if ($i%2==0)
                        <li class="py-sm-5 py-lg-0 py-md-5" data-aos="fade-left" data-aos-delay="">
                            <div class="timeline-image">
                            </div>
                            <div class="timeline-panel">
                                <div class="timeline-heading">

                                    <h4 class="text-primary">{{$sessions[$i]->date}}</h4>

                                </div>
                                <div class="timeline-body">
                                    <p class="h6 text-primary text-muted">
                                    {{$sessions[$i]->subject}}
                                     </p>
                                                            <a class="btn mt-3 btn-light" href="{{ route('student.classroom.session',['sessionid'=>$sessions[$i]->sessionID , 'classroomid'=> $classroomid ?? $sessions[$i]->classroomID]) }}"> Details</a>

                                </div>
                            </div>
                            <div class="line"></div>
                        </li>
                                @else

                <li class="timeline-inverted mt-5" data-aos="fade-right" data-aos-duration="1000" data-aos-delay="200">
                    <div class="timeline-image">

                    </div>
                    <div class="timeline-panel">
                        <div class="timeline-heading">
                            <h4></h4>
                            <h4 class="text-primary">{{$sessions[$i]->date}}</h4>
                        </div>
                        <div class="timeline-body">
                            <p class="h6 text-muted">
                                {{$sessions[$i]->subject}}
                             </p>
                            <a class="btn btn-light mt-3" href="{{ route('student.classroom.session',['sessionid'=>$sessions[$i]->sessionID , 'classroomid'=> $classroomid ?? $sessions[$i]->classroomID]) }}"> Details</a>

                        </div>
                    </div>
                    <div class="line"></div>
                </li>

                    @endif
                                    @endfor

            </ul>
        </div>
    </div>
</div>

@endsection
