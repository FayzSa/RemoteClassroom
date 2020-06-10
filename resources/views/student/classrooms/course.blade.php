@extends('layouts.student-app')
@section('style')
    <link rel="stylesheet" href="{{ asset('css/comment.css')}}">
  @endsection
@section('title')
    {{$course->getName()}}
@endsection
@section('start')
    <div class="row pt-5"></div>
    <div class="site-section courses-title" id="courses-section">
        <div class="container">
            <div class="row mb-5 justify-content-center">
                <div class="col-7 text-center" data-aos="fade-up" data-aos-delay="">
                    <h2 class="section-title"> {{$course->getName()}}</h2>
                    <h5 class="section-title" data-aos="fade-right" data-aos-delay="" style="font-size: 140%"> {{$course->getDescription()}}</h5>
                </div>
            </div>

        </div>

    </div>
    </div>
@endsection
@section('content')

    <div class="container-fluid py-3"><div class="row ">
        @foreach($course->getFiles() as $file)

            <a href="{{$file}}" data-aos="fade-left" data-aos-delay="" class="btn m-auto btn-primary">download course</a>


    @endforeach
        </div>
    </div>



 <!------ Include the above in your HEAD tag ---------->


    <div class="container-fluid mt-5">
        <div class="row">
            <div class="col-lg-5 col-md-10 col-sm-12 m-auto" data-aos="fade-right" data-aos-delay="">
                <div class="row px-5"><h3>Add Comment</h3></div>
                <form action="{{route('student.classroom.course.comment')}}" method="post" class="form-horizontal" id="commentForm" role="form">
                    <div class="form-group">
{{--                        <label for="title" class="col-sm-2 control-label">Comment Title</label>--}}
                        <div class="col-sm-10">
                            <input class="form-control" hidden name="title" value="{{$course->getName()}}" placeholder="title" id="title" />
                        </div>
                    </div>
                    <div class="form-group">
{{--                        <label for="body" class="col-sm-2 control-label">body</label>--}}
                        <div class="col-sm-10">
                            <textarea class="form-control" name="body" placeholder="your Comment" id="body" rows="5"></textarea>
                        </div>
                    </div>
                    @csrf
                    <input type="hidden" name="courseid" value="{{$course->getCourseId()}}">
                    <div class="form-group ">
                        <div class="col-sm-offset-2 px-5 col-sm-10">
                            <button class="btn btn-primary m-auto btn-circle text-uppercase" type="submit" id="submitComment"><span class="glyphicon glyphicon-send"></span> Send Comment</button>
                        </div>
                    </div>
                </form>
            </div>

            <div class="col-lg-5 col-md-10  col-sm-12  mx-auto" >

                <div class="row mx-auto" ><h3>Comments</h3></div>
                <div class="row "  style="height: 300px ;overflow-y: auto;overflow-x: hidden">
                    @foreach($course->getComments() as $comment)

                        <div class="row pb-3" >
                            <div class="col-2">
                                <div class="thumbnail">
                                    <img class="img-fluid img-responsive user-photo" src="{{$comment->getOwenrPic()}}">
                                </div><!-- /thumbnail -->
                            </div><!-- /col-sm-1 -->

                            <div class="ml-2 col-6" >
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <strong>{{$comment->getOwenrName()}}</strong><br> <span class="text-muted ml-4">{{$comment->dateComment}}</span>
                                    </div>
                                    <div class="panel-body ">
                                        {{$comment->getBody()}}
                                    </div><!-- /panel-body -->
                                </div><!-- /panel panel-default -->
                            </div>
                        </div>
                    @endforeach

                </div>


                    {{--                             <li class="media">--}}
                    {{--                                 <a class="pull-left" href="#">--}}
                    {{--                                     <img class="media-object img-circle" src="{{$comment->getOwenrPic()}}" alt="profile">--}}
                    {{--                                     <h5 class="media-heading mt-2 center text-uppercase reviews">{{$comment->getOwenrName()}}</h5>--}}
                    {{--                                 </a>--}}
                    {{--                                 <div class="media-body">--}}
                    {{--                                     <div class="well well-lg">--}}
                    {{--                                    <h4>{{$comment->getTitle()}}</h4>--}}
                    {{--                                         <ul class="media-date text-uppercase reviews list-inline">--}}

                    {{--                                         </ul>--}}

                    {{--                                         <p class="media-comment">--}}
                    {{--                                             <h6>{{$comment->getBody()}}</h6>--}}
                    {{--                                         </p>--}}

                    {{--                                     </div>--}}
                    {{--                                 </div>--}}
                    {{--                             </li>--}}


            </div>
        </div>
    </div>

{{-- <div class="container">--}}
{{--     <div class="row">--}}
{{--         <div class="col-sm-10 col-sm-offset-1" id="logout">--}}
{{--             <div class="page-header">--}}
{{--                 <h3 class="reviews">Leave your comment</h3>--}}

{{--             </div>--}}
{{--             <div class="comment-tabs">--}}
{{--                 <ul class="nav nav-tabs" role="tablist">--}}
{{--                     <li class="active"><a href="#comments-logout" role="tab" data-toggle="tab"><h4 class="reviews text-capitalize">Comments</h4></a></li>--}}
{{--                     <li><a href="#add-comment" role="tab" data-toggle="tab"><h4 class="reviews text-capitalize">Add comment</h4></a></li>--}}
{{--                 </ul>--}}
{{--                 <div class="tab-content">--}}
{{--                     <div class="tab-pane active" id="comments-logout">--}}
{{--                         <ul class="media-list">--}}
{{--                                @foreach($course->getComments() as $comment)--}}

{{--                                 <div class="row">--}}
{{--                                     <div class="col-sm-1">--}}
{{--                                         <div class="thumbnail">--}}
{{--                                             <img class="img-responsive user-photo" src="{{$comment->getOwenrPic()}}">--}}
{{--                                         </div><!-- /thumbnail -->--}}
{{--                                     </div><!-- /col-sm-1 -->--}}

{{--                                     <div class="col-sm-5">--}}
{{--                                         <div class="panel panel-default">--}}
{{--                                             <div class="panel-heading">--}}
{{--                                                 <strong>{{$comment->getOwenrName()}}</strong> <span class="text-muted">commented 5 days ago</span>--}}
{{--                                             </div>--}}
{{--                                             <div class="panel-body">--}}
{{--                                                 {{$comment->getBody()}}--}}
{{--                                             </div><!-- /panel-body -->--}}
{{--                                         </div><!-- /panel panel-default -->--}}
{{--                                     </div>--}}
{{--                                 </div>--}}


{{--                             <li class="media">--}}
{{--                                 <a class="pull-left" href="#">--}}
{{--                                     <img class="media-object img-circle" src="{{$comment->getOwenrPic()}}" alt="profile">--}}
{{--                                     <h5 class="media-heading mt-2 center text-uppercase reviews">{{$comment->getOwenrName()}}</h5>--}}
{{--                                 </a>--}}
{{--                                 <div class="media-body">--}}
{{--                                     <div class="well well-lg">--}}
{{--                                    <h4>{{$comment->getTitle()}}</h4>--}}
{{--                                         <ul class="media-date text-uppercase reviews list-inline">--}}

{{--                                         </ul>--}}

{{--                                         <p class="media-comment">--}}
{{--                                             <h6>{{$comment->getBody()}}</h6>--}}
{{--                                         </p>--}}

{{--                                     </div>--}}
{{--                                 </div>--}}
{{--                             </li>--}}
{{--                            @endforeach--}}
{{--                         </ul>--}}
{{--                     </div>--}}
{{--                     <div class="tab-pane" id="add-comment">--}}

{{--                     </div>--}}

{{--                 </div>--}}
{{--             </div>--}}
{{--         </div>--}}
{{--     </div>--}}

@endsection
