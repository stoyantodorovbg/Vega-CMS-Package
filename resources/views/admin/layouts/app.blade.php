<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.custom_name', 'Vegacms CMS') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
<div id="app" data-locale="{{ config('cms.locales.codes', [''])[0] ? app()->getLocale() : '' }}">
    <main :class="currentTheme ? currentTheme : 'theme-default'">
        @include('vegacms::front.partials.nav')
        <div class="container-fluid admin-content-wrapper">
            <div class="row">
                <div class="col-md-12 col-lg-2 sidebar-main">
                    <dynamic-menu :menu_id="1"></dynamic-menu>
                </div>
                <div class="col-md-12 col-lg-10">
                    <div class="admin-panel">
                        @yield('content')
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>
</body>
</html>
