<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="x-csrf-token" content="{{csrf_token()}}">
    <link rel="stylesheet" href="{{asset('/css/full-screen.css')}}">
    <link rel="stylesheet" href="{{asset('/css/global.css')}}">
    <link rel="stylesheet" href="{{asset('/css/verification.css')}}">
    <title>Register</title>
</head>
<body>

<div class="container">
    <form id="form-register">
        <div class="form-row">
            <label for="username">Username</label>
            <input type="text" name="username" id="username">
        </div>
        <div class="form-row">
            <label for="password">Password</label>
            <input type="password" name="password" id="password">
        </div>
        <div class="form-row">
            <button type="submit">Register</button>
            <a class="text-register" href="/login">Already have an account?</a>
        </div>
    </form>
</div>

<script src="{{asset('/js/UI/auth/registerRequest.js')}}"></script>

</body>
</html>
