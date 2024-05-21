<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>@yield('title','Document')</title>
    <link rel="stylesheet" href="{{ asset('assets\css\Header.css') }}">
    <link rel="stylesheet" href="{{ asset('assets\css\footer.css') }}">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</head>
<body>
    @include("layout.header")

    @yield('content') 

    @include("layout.footer")

</body>
</html>