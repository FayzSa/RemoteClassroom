<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
@foreach($courses as $course)

    <h1>{{$course->getCourseId()}}</h1>
    @foreach($course->getComments() as $comment)
        <h3>{{$comment->getTitle()}}</h3>

    @endforeach
@endforeach

</body>
</html>

