<!doctype html>
<html lang="en">
    <head>
        <base href="{{ url('/') }}">
        <meta charset="utf-8">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Book Review App</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer"/>
        <link rel="stylesheet" href="https://unpkg.com/bootstrap@5.3.2/dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="assets/css/style.css">
    </head>
    <body class="bg-light">
        <div class="container-fluid shadow-lg header">
            <div class="container">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="d-flex align-items-center">
                        <img src="assets/images/logo.png" alt="Book Browse Logo" style="height: 70px; margin-right: 10px;">
                        <h1 class="text-center"><a href="{{route('home')}}" class="h3 text-white text-decoration-none">Book Browse</a></h1>
                    </div>
                    <div class="d-flex align-items-center navigation">
                        @if (Auth::check())
                        <a href="{{route('account.profile')}}" class="text-white">Account</a> 
                        @else
                        <a href="{{route('account.login')}}" class="text-white">Login</a>
                        <a href="{{route('account.register')}}" class="text-white ps-2">Register</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
