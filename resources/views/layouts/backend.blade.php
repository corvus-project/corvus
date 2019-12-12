<!DOCTYPE html>
<html lang="en">

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


<body class="app header-fixed sidebar-fixed aside-menu-off-canvas sidebar-lg-show">
    @include('includes.header')

    <div class="app-body">
        @include('includes.sidebar')

        <main class="main">

            <div class="container-fluid">
                <div class="animated fadeIn">
                    <div class="content-header">
                        @yield('page-header')
                    </div>
                    <!--content-header-->
                    @include('includes.partials.messages')
                    <div class="mt-2">
                        @yield('content')
                    </div>
                </div>
                <!--animated-->
            </div>
            <!--container-fluid-->
        </main>
        <!--main--> 
    </div>
    <!--app-body-->

    @include('includes.footer')

    <!-- Scripts -->
    @stack('before-scripts')
    {!! script(mix('js/manifest.js')) !!}
    {!! script(mix('js/vendor.js')) !!}
    {!! script(mix('js/backend.js')) !!}
    @stack('after-scripts')
     
    @yield('scripts')
</body>

</html>