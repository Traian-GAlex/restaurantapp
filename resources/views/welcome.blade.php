<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{config('app.name')}}</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <link rel="stylesheet" href="{{asset('css/custom.css')}}">

</head>
<body>
<div class="overlay"></div>
<div class="welcome-image"></div>
<div class="welcome-content text-center">
    <div class="w-title">Restaurant App</div>
    <div class="row w-buttons">
        <div class="col">
            <button class="btn btn-outline-light btn-block">Login</button>

        </div>
        <div class="col"><button class="btn btn-outline-light btn-block">Register</button></div>
    </div>
</div>
</body>
</html>
