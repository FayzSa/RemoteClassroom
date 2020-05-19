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
<div class="container mt-5">
    <form method="post" action="/student/create">
        @csrf
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" name="name" id="name" aria-describedby="emailHelp" placeholder="Enter your name">
        </div>
        <div class="form-group">
            <label for="lastname">Last Name</label>
            <input type="text" class="form-control" name="lastname" id="lastname" aria-describedby="emailHelp" placeholder="Enter your last name">
        </div>
        <div class="form-group">
            <label for="invitecode">Invite Code</label>
            <input type="text" class="form-control" name="invitecode" id="invitecode" aria-describedby="emailHelp" placeholder="Enter your invite code">
            <small id="emailHelp" class="form-text text-muted">enter a code that the prof gives you.</small>
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Email address</label>
            <input type="email" class="form-control" name="email" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
            <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Password</label>
            <input type="password" class="form-control"name="password" id="exampleInputPassword1" placeholder="Enter Password">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
</body>
</html>
