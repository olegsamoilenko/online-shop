<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{--         Не понятно, нормально так или нет--}}
    <meta name="user-id" content="{{ Auth::user() }}">


    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
<div id="app">
    @if (Auth::check())
        <the-header :user="{{Auth::user()->load('roles')}}"></the-header>
    @else
        <the-header></the-header>
    @endif

    @yield('content')

        <the-subscribe></the-subscribe>
        <the-footer></the-footer>
</div>
<div id="modal"></div>
</body>
</html>
