<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <meta name="csrf-token" content="{{csrf_token()}}">
    <title>Document</title>
</head>
<body>
<div class="container mt-5 p-5">
    <form method="post" action="{{route('live.create')}}">
        @csrf
        <div class="form-group">
            <label for="lastname">name dans le live</label>
            <input type="text" class="form-control" name="username" id="lastname" aria-describedby="emailHelp" placeholder="Enter your last name">
        </div>
        <div class="form-group">
            <label for="password">the teacher password</label>
            <input type="text" class="form-control" name="password" id="password" aria-describedby="password" placeholder="Enter teacher password">
            <small id="password" class="form-text text-muted">any teacher we wnt to join the live as teacher will use that password</small>
        </div>
        <div class="form-group">
            <label for="attendedpassword">the student password</label>
            <input type="text" class="form-control" name="attendedpassword" id="attendedpassword" aria-describedby="emailHelp" placeholder="Enter student password">
            <small id="attendedpassword" class="form-text text-muted">any student we want to join the live as student will use that password</small>
        </div>
        <div class="form-group">
            <label for="meeting">the meeting id later we will use invite code</label>
            <input type="text" class="form-control" name="meeting" id="meeting" aria-describedby="emailHelp" placeholder="Enter the meeting id">
            <small id="meeting" class="form-text text-muted">any one want to join the live will need these meeting id</small>
        </div>
        <div class="form-group">
            <label for="meetingname">the name of the meeting | the course name</label>
            <input type="text" class="form-control" name="meetingname" id="meetingname" aria-describedby="meetingname" placeholder="Enter name of meeting">
            <small id="meetingname" class="form-text text-muted">the name of the course for exemple english</small>
        </div>
        <div class="form-group">
            <label for="welcomemessage">welcome message what you want to say to the student in the live when they join it </label>
            <input type="text" class="form-control" name="welcomemessage" id="welcomemessage" aria-describedby="welcomemessage" placeholder="Enter the welcome message ">
            <small id="welcomemessage" class="form-text text-muted">the welcome message</small>

        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
</body>
</html>
