<!DOCTYPE html>
<html>

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>{{ config('app.name', 'Laravel') }}</title>
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <meta name="csrf-token" content="{{ csrf_token() }}" />
    
        <link rel="icon" href="{{ asset('assets/images/logo.jpg') }}" type="image/x-icon" />
    
        <link rel="stylesheet" href="{{ asset('assets/css/animate.min.css') }}" />
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/pretest.css') }}">
    
        <script type="text/javascript" src="{{ asset('assets/js/jquery-min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('courses/loader.js') }}"></script>
    </head>

<body>

    @yield('content')

</body>

</html>