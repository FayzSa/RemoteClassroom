@extends('layouts.student-app')

@section('title')
    {{$course->getName()}}
@endsection

@section('content')
 <h1 class="text-center">{{$course->getName()}}</h1>

 <h3 class="text-justify">{{$course->getDescription()}}</h3>
 @foreach($course->getFiles() as $file)
 <a href="{{$file}}" class="btn btn-success">download course</a>
 @endforeach
 <link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
 <script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
 <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
 <!------ Include the above in your HEAD tag ---------->

 <div class="container">
     <div class="row">
         <div class="col-sm-10 col-sm-offset-1" id="logout">
             <div class="page-header">
                 <h3 class="reviews">Leave your comment</h3>

             </div>
             <div class="comment-tabs">
                 <ul class="nav nav-tabs" role="tablist">
                     <li class="active"><a href="#comments-logout" role="tab" data-toggle="tab"><h4 class="reviews text-capitalize">Comments</h4></a></li>
                     <li><a href="#add-comment" role="tab" data-toggle="tab"><h4 class="reviews text-capitalize">Add comment</h4></a></li>
                 </ul>
                 <div class="tab-content">
                     <div class="tab-pane active" id="comments-logout">
                         <ul class="media-list">
                                @foreach($course->getComments() as $comment)
                             <li class="media">
                                 <a class="pull-left" href="#">
                                     <img class="media-object img-circle" src="https://s3.amazonaws.com/uifaces/faces/twitter/kurafire/128.jpg" alt="profile">
                                     <h5 class="media-heading mt-2 center text-uppercase reviews">{{$comment->getOwnerId()}}</h5>
                                 </a>
                                 <div class="media-body">
                                     <div class="well well-lg">
                                    <h4>{{$comment->getTitle()}}</h4>
                                         <ul class="media-date text-uppercase reviews list-inline">

                                         </ul>

                                         <p class="media-comment">
                                             <h6>{{$comment->getBody()}}</h6>
                                         </p>

                                     </div>
                                 </div>
                             </li>
                            @endforeach
                         </ul>
                     </div>
                     <div class="tab-pane" id="add-comment">
                         <form action="{{route('student.classroom.course.comment')}}" method="post" class="form-horizontal" id="commentForm" role="form">
                             <div class="form-group">
                                 <label for="title" class="col-sm-2 control-label">Comment Title</label>
                                 <div class="col-sm-10">
                                     <input class="form-control" name="title" id="title" />
                                 </div>
                             </div>
                             <div class="form-group">
                                 <label for="body" class="col-sm-2 control-label">body</label>
                                 <div class="col-sm-10">
                                     <textarea class="form-control" name="body" id="body" rows="5"></textarea>
                                 </div>
                             </div>
                             @csrf
                             <input type="hidden" name="courseid" value="{{$course->getCourseId()}}">
                             <div class="form-group">
                                 <div class="col-sm-offset-2 col-sm-10">
                                     <button class="btn btn-success btn-circle text-uppercase" type="submit" id="submitComment"><span class="glyphicon glyphicon-send"></span> Summit comment</button>
                                 </div>
                             </div>
                         </form>
                     </div>

                 </div>
             </div>
         </div>
     </div>

<<<<<<< HEAD
@endsection
=======
@endsection
>>>>>>> 4c1b12788c3ba03083bdb7310c36847d81907097
