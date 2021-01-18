<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <script src="{{ asset('js/app.js') }}"></script>
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">  
        <title>Admin - @yield('title')</title>
    </head>
    <body>
        <div class="navbar fixed-top bg-dark text-center text-light">LittlePaws - Admin</div>
        <br><br>
        @include('layouts.adminNavbar')

        @yield('content')

        <div class="navbar fixed-bottom bg-dark text-center text-light">Copyright © 2021 LittlePaws. All rights reserved. Icons by <a target="_blank" href="https://iconbros.com">IconBros</a> & <a href="https://www.flaticon.com/" title="Flaticon">FlatIcon</a></div>
    </body>
</html>