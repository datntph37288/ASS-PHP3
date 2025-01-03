<!DOCTYPE html>
<html lang="en">

<head>
    <title>Shoppers &mdash; Colorlib e-Commerce Template</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">


    @include('clients.layout.partials.css')
</head>

<body>

    <div class="site-wrap">
        <header class="site-navbar" role="banner">

            @include('clients.layout.partials.header_top')

            @include('clients.layout.partials.header_nav')

        </header>
        @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
        @include('clients.layout.partials.slide')

        @include('clients.layout.partials.site_blocks')

        @yield('content')

        <footer class="site-footer border-top">
            @include('clients.layout/partials/footer')
        </footer>
    </div>
    @include('clients.layout/partials/js')

</body>

</html>
