<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8" />
    <meta name="description" content="Shayna Template" />
    <meta name="keywords" content="Shayna, unica, creative, html" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>@yield('title')</title>

    @include('includes.frontend.styles')
</head>

<body>
    <!-- Page Preloder -->
    <div id="preloder">
        <div class="loader"></div>
    </div>

    @yield('content')

    

    <!-- Footer Section Begin -->
    @include('includes.frontend.footer')
    <!-- Footer Section End -->

    <!-- Js Plugins -->
    @include('includes.frontend.scripts')
</body>

</html>