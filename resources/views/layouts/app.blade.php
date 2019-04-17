<html lang="en">
<head>
    <title> NLAB - Task List App</title>

    <!-- CSS And JavaScript -->

    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>

</head>

<body>
<div class="container align-items-center">
    <nav class="navbar navbar-default" style="height: 50px">
        <!-- Navbar Contents -->
    </nav>
</div>

@yield('content')

</body>
</html>