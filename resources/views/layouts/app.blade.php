<?php
    use Illuminate\Support\Facades\Auth;

    $current_user = Auth::user();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Wieke's weblog - @yield('title')</title>
</head>
<body>
    @include('partials.nav')
    @yield('content')
</body>
</html>