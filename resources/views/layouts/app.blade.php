<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', app_name())</title>
    @yield('meta')

    @stack('before-styles')
 
    {{ style(mix('css/backend.css')) }}

    @stack('after-styles')
    @yield('styles')
</head>
<body class="flex-row align-items-center welcome">
    <div class="container">
        @include('includes.partials.messages')
        @yield('content')
    </div><!-- container -->


    <!-- Scripts -->
    @stack('before-scripts')
    {!! script(mix('js/manifest.js')) !!}
    {!! script(mix('js/vendor.js')) !!}
    {!! script(mix('js/backend.js')) !!}
    @stack('after-scripts')

</body>

</html>