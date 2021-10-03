<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>@yield('title')</title>

@include('includes.auth.styles')
@stack('styles')
</head>
<body class="hold-transition login-page">

    @yield('content')
<!-- /.login-box -->

@include('includes.auth.scripts')
@stack('scripts')
</body>
</html>
