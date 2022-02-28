<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <title>Scolmore Development Team</title>
    </head>
    <body class="bg-gray-300">
        <nav class="p-6 bg-gray-500 flex justify-between mb-6">
            <ul class="flex items-center">
                <img src="img/logo.jpg" style="height: 30px;">
            </ul>
            <ul class="flex items-center">
                <li class="p-3">
                    <a href="{{ route('index') }}">Home</a>
                </li>
                <li class="p-3">
                    <a href="{{ route('upload') }}">Upload Transactions</a>
                </li>
            </ul>
        </nav>
        @yield('content')
    </body>
</html>