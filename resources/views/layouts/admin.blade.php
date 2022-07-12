<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{--    Не понятно, нормально так или нет --}}
{{--        <meta name="user" content="{{ Auth::user() }}">--}}

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
    <div class="flex">
        <the-sidebar-admin :user="{{ Auth::user()->load('roles')}}"></the-sidebar-admin>

        <div class="flex-1 flex flex-col overflow-hidden">
            <the-header-admin :user="{{ Auth::user() }}"></the-header-admin>

            <main class="flex-1 overflow-x-hidden overflow-y-auto">
                <div class="container mx-auto px-6 py-8">

                    @yield('content')

                </div>
            </main>
        </div>
    </div>


</div>
<div id="modal"></div>

</body>
</html>

