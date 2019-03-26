<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ mix('css/app.css')}}">
    <link rel="stylesheet" href="{{ asset('css/login.css')}}">
    <script src="{{ mix('js/app.js') }}"></script>
    <script src="{{ asset('js/login.js') }}"></script>
    <title>Login</title>
</head>

<body>
    <div class="loadingBackground" style="display:none">
        <div class="text-center">
            <img src="{{ asset('images/loading.gif') }}">
        </div>
    </div>
    <div class="main">
        <div class="login-form">
            <form action="admin/login" method="post">
                @csrf
                <div class="input-group input-group-lg">
                    <div class="input-group-prepend">
                        <span class="fa fa-user input-group-text"></i> 
                    </div>
                    <input type="text" class="form-control" name="username" placeholder="Username" aria-describedby="sizing-addon1">
                </div>
                <div class="input-group input-group-lg">
                    <div class="input-group-prepend">
                        <span class="fa fa-lock input-group-text"></i> 
                    </div>
                    <input type="password" class="form-control" name="password" placeholder="Password" aria-describedby="sizing-addon1">
                </div>
                <div class="submit">
                    <button type="button" class="signIn">Sign In</button>
                </div>
            </form>
        </div>
    </div>
    <footer class="footer-fixed">
        <img src="{{ asset('images/violator_new_blue.png') }}" class="img-responsive">
    </footer>
</body>

</html>