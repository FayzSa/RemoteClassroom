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
    <form method="post" action="{{route('live.join')}}">
        @csrf
        <div class="form-group">
            <label for="lastname">name dans le live</label>
            <input type="text" class="form-control" name="username" id="lastname" aria-describedby="emailHelp" placeholder="Enter your last name">
        </div>
        <div class="form-group">
            <label for="meetingid">the meeting id that prof gives you</label>
            <input type="text" class="form-control" name="meetingId" id="meetingid" aria-describedby="password" placeholder="Enter the meeting id">
            <small id="password" class="form-text text-muted">the meeting id that the proofn  gives you </small>
        </div>

        <div class="form-group">
            <label for="password">the password that the prof gives you</label>
            <input type="text" class="form-control" name="password" id="password" aria-describedby="password" placeholder="Enter teacher password">
            <small id="password" class="form-text text-muted">any teacher we wnt to join the live as teacher will use that password</small>
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
</body>
</html>
