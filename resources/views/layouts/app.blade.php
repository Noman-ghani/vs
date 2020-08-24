<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <link rel="icon" href="{{ asset('assets/images/logo.jpg') }}" type="image/x-icon"/>
    
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body class="hold-transition login-page">
    <div class="bg-image"></div>
    <div class="login-box">
        <div class="login-box-body box-shadow-2 p-0">
            <div class="card border-grey border-lighten-3 m-0">
                <div class="card-content">
                    <div class="card-body">
                        <div class="avatar">
                            <i class="fa fa-user"></i>
                        </div>
                        @yield('content')
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>