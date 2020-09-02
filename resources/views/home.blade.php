<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name', 'Laravel') }}</title>
        <link rel="icon" href="{{ asset('assets/images/logo.jpg') }}" type="image/x-icon"/>

        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    </head>
    <body class="hold-transition">
        <div id="app">
            <component :is="this.$route.meta.layout || 'div'">
                <router-view></router-view>
            </component>
        </div>
        <script src="{{ URL::asset('js/app.js') }}" defer></script>
    </body>
</html>