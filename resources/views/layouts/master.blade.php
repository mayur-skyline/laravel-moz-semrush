<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    @include('layouts.css')
</head>
<body class="font-sans bg-gray-100">

    @yield('content')

    @include('layouts.js')

</body>
</html>

