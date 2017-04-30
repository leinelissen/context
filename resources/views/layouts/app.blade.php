<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="apple-mobile-web-app-capable" content="yes">
        <link rel="apple-touch-icon" href="apple-touch-icon.png">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="viewport" content="width=device-width, user-scalable=no" />

        <link rel="stylesheet" href="{{ mix('/css/app.css') }}">

        <title>{{ config('app.name') }}</title>
    </head>
    <body>
        @yield('body')

        @if(Auth::check())
            <script type="text/javascript">
                window.userid = {{ Auth::id() }};
                @stack('js_variables')
            </script>
        @endif
        <script src="{{ mix('/js/manifest.js') }}"></script>
        <script src="{{ mix('/js/vendor.js') }}"></script>
        <script src="{{ mix('/js/app.js') }}"></script>
    </body>
</html>
