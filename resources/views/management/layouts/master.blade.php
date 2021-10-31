<!DOCTYPE html>
<!-- saved from url=(0053)https://demo.dashboardpack.com/kero-html-sidebar-pro/ -->
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Language" content="en">

    <meta name="csrf-token" content="{{ csrf_token() }}">


    <title>Talab Station  طلب ستيشن</title>
    <link rel="icon" href="{!! asset('Dashboard-UI/images/talab-station-logo.png') !!}"/>

    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no">
    <meta name="description" content="This is an example dashboard created using build-in elements and components.">
    <!-- <link rel="icon" href="https://demo.dashboardpack.com/kero-html-sidebar-pro/favicon.ico"> -->

    <script src="https://code.iconify.design/1/1.0.7/iconify.min.js"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <!-- <script src="https://code.iconify.design/1/1.0.7/iconify.min.js"></script> -->

    <!-- Disable tap highlight on IE -->
    <meta name="msapplication-tap-highlight" content="no">
    <link rel="stylesheet" href="{{ asset('Dashboard-UI/main.07a59de7b920cd76b874.css') }}">

    <link rel="stylesheet" href="{{ asset('Dashboard-UI/style2.css') }}">
    @include('management.partials.style')
    @yield('style')

    
</head>

<body>
    <div class="app-container app-theme-gray">
        <div class="app-main">
            @include('management.partials.side-bar')

            <div class="app-main__outer">
                <div class="app-main__inner">
                    <div class="header-mobile-wrapper">
                        <div class="app-header__logo">
                            <a href="https://demo.dashboardpack.com/kero-html-sidebar-pro/#" data-toggle="tooltip" data-placement="bottom" title="" class="logo-src" data-original-title="KeroUI Admin Template"></a>
                            <button type="button" class="hamburger hamburger--elastic mobile-toggle-sidebar-nav">
                                <span class="hamburger-box">
                                    <span class="hamburger-inner"></span>
                                </span>
                            </button>
                            <div class="app-header__menu">
                                <span>
                                    <button type="button" class="btn-icon btn-icon-only btn btn-primary btn-sm mobile-toggle-header-nav">
                                        <span class="btn-icon-wrapper">
                                            <i class="fa fa-ellipsis-v fa-w-6"></i>
                                        </span>
                                    </button>
                                </span>
                            </div>
                        </div>
                    </div>
                    @include('management.partials.header')

                    <div class="app-inner-layout app-inner-layout-page">
                        @include('management.partials.nav-bar')

                        <div class="app-inner-layout__content">
                            <div class="tab-content">
                                @yield('content')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @include('management.partials.footer')
        </div>
    </div>
   

    @include('management.partials.scripts')
    @yield('scripts')
    <svg id="SvgjsSvg1001" width="2" height="0" xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs" style="overflow: hidden; top: -100%; left: -100%; position: absolute; opacity: 0;">
        <defs id="SvgjsDefs1002"></defs>
        <polyline id="SvgjsPolyline1003" points="0,0"></polyline>
        <path id="SvgjsPath1004" d="M-1 152L-1 152C-1 152 25.304347826086957 152 25.304347826086957 152C25.304347826086957 152 50.608695652173914 152 50.608695652173914 152C50.608695652173914 152 75.91304347826087 152 75.91304347826087 152C75.91304347826087 152 101.21739130434783 152 101.21739130434783 152C101.21739130434783 152 126.52173913043478 152 126.52173913043478 152C126.52173913043478 152 151.82608695652175 152 151.82608695652175 152C151.82608695652175 152 177.13043478260872 152 177.13043478260872 152C177.13043478260872 152 202.43478260869566 152 202.43478260869566 152C202.43478260869566 152 227.73913043478262 152 227.73913043478262 152C227.73913043478262 152 253.04347826086956 152 253.04347826086956 152C253.04347826086956 152 278.34782608695656 152 278.34782608695656 152C278.34782608695656 152 303.6521739130435 152 303.6521739130435 152C303.6521739130435 152 328.95652173913044 152 328.95652173913044 152C328.95652173913044 152 354.26086956521743 152 354.26086956521743 152C354.26086956521743 152 379.5652173913044 152 379.5652173913044 152C379.5652173913044 152 404.8695652173913 152 404.8695652173913 152C404.8695652173913 152 430.17391304347825 152 430.17391304347825 152C430.17391304347825 152 455.47826086956525 152 455.47826086956525 152C455.47826086956525 152 480.7826086956522 152 480.7826086956522 152C480.7826086956522 152 506.0869565217391 152 506.0869565217391 152C506.0869565217391 152 531.3913043478261 152 531.3913043478261 152C531.3913043478261 152 556.6956521739131 152 556.6956521739131 152C556.6956521739131 152 582 152 582 152C582 152 582 152 582 152 "></path>
    </svg>
    <div class="jvectormap-tip"></div>
</body>

</html>

</html>