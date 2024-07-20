<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg"
    data-sidebar-image="none" data-preloader="disable">

<head>
    <meta charset="utf-8" />
    <title>Dashboard | Velzon - Admin & Dashboard Template</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesbrand" name="author" />
    @include('admins.layout.partials.css')
</head>

<body>
    <!-- Begin page -->
    <div id="layout-wrapper">
        <header id="page-topbar">
            <div class="layout-width">
                @include('admins.layout.partials.header_navbar')
            </div>
        </header>
        <div class="app-menu navbar-menu">
            <!-- LOGO -->
            @include('admins.layout.partials.logo')

            @include('admins.layout.partials.header_navbar_menu')

            <div class="sidebar-background"></div>
        </div>

        <!-- main content -->
        <div class="main-content">
            <div class="page-content">
                @yield('content')
            </div>

            @include('admins.layout.partials.footer')
        </div>
    </div>

    @include('admins.layout.partials.theme_settings')

    <!-- JAVASCRIPT -->
    @include('admins.layout.partials.js')
</body>

</html>
