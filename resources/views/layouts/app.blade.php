<!DOCTYPE html>
<html>
<head>
    <title>@yield('title')</title>
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('css/app.css') }}" />
    <link href='http://fonts.googleapis.com/css?family=Lato' rel='stylesheet' type='text/css'>
</head>
<body>

<nav>
    <a href="/">Home</a>
</nav>

<div class="container">
    @yield('content')
    @yield('charts')
</div>

<script src="{{ URL::asset('js/base.js') }}"></script>
<script src="{{ URL::asset('js/all.js') }}"></script>

</body>
</html>
