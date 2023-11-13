<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{env("APP_NAME")}}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet"/>

</head>
<body class="antialiased">
<div
    class="relative sm:flex sm:justify-center sm:items-center min-h-screen bg-dots-darker bg-center bg-gray-100
     selection:bg-red-500 selection:text-white">

    <div class="sm:fixed sm:top-0 sm:right-0 p-6 text-right z-10">

        <a href="{{ route('login') }}"
           class="font-semibold text-gray-600 hover:text-gray-900  focus:outline
               focus:outline-2 focus:rounded-sm focus:outline-red-500">ورود کارمند</a>
        <a href="{{ route('teacher.login') }}"
           class="font-semibold text-gray-600 hover:text-gray-900  focus:outline
               focus:outline-2 focus:rounded-sm focus:outline-red-500">ورود معلم</a>
    </div>

</div>
</body>
</html>
