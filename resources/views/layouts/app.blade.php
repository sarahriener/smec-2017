<!DOCTYPE html>
<html>
<head>
    <title>@yield('title')</title>
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('css/app.css') }}" />
</head>
<body>

<nav>
    <a href="/">Home</a>
</nav>

<div class="container">
    @yield('content')
</div>

<script src="{{ URL::asset('js/all.js') }}"></script>
<script src="{{ URL::asset('js/jQueryTest.js') }}"></script>

</body>
</html>
