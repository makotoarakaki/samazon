<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/original.css')}}" rel="stylesheet">

    <script src="https://kit.fontawesome.com/3723f06c66.js" crossorigin="anonymous"></script>
</head>
<body>
    <div id="app">
        @component('components.item_header')
        @endcomponent
        <main class="py-4 mb-5">
            <script>
                $(function() {
                    $('.loadbtn').on('click', function() {
                        $('.loadbtn').hide();
                        $('#loading').show();
                    });
                });            
            </script>
            <!-- ローディング画面 -->
            <div id="loading">
                <div class="spinner"></div>
            </div>
            @yield('content')
        </main>
        @component('components.footer')
        @endcomponent
    </div>
</body>
</html>
