<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{env("APP_NAME")}}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link rel="stylesheet" href="/css/app.css">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet"/>


</head>
<body class="antialiased">
<div id="desktopHeader" class=" bg-white md:block hidden w-full shadow shadow-lg">
    <div id="searchBox" class="mx-auto bg-gray-50 hidden w-full p-4 flex
     items-center justify-between ">
        <div class="m-auto w-full ">
        </div>
    </div>
    <div class="h-5">
        <span></span>
    </div>
    <div class="mx-auto w-full  flex items-center justify-between max-w-[1200px]">
        <div class="flex gap-x-10 items-center ">
            <div class="flex items-center ">
                <a href="/">
                    <img src="/images/images.jpg"
                         class="bg-transparent relative w-44 h-24 " alt="sfc">
                </a>
            </div>
        </div>
        <div class="flex  items-center justify-between">
            <div class="m-auto px-3 pt-4">
            </div>
            @auth()
                <a href="{{route("admin.dashboard")}}"
                   class="py-3 rounded text-white text-lg px-6 m-auto bg-green-500 hover:bg-green-700  ">
                    پنل ادمین
                </a>
            @else
                <a href="{{route("login")}}"
                   class="py-3 rounded text-white text-lg px-6 m-auto bg-green-500 hover:bg-green-700  ">
                    ورود کارمندان
                </a>

            @endauth

        </div>
    </div>
</div>
<main>
    <div class="my-20">

        <div class=" max-w-7xl mx-auto rounded md:flex hidden mt-14 -mb-16 md:mt-4 text-white justify-center
 gap-28  items-center
 flex-col
 md:flex-row  h-[800px] md:h-[500px]">
            <div class=" max-w-md border bg-white border-gray-200 rounded-lg ">
                <a href="/products?category=Y2NTE">
                    <img src="/images/images.jpg" class=" " alt="ادوات ">
                </a>
                <div class="flex justify-center items-center  text-center p-3">
                    <div class="">
                        @auth("teacher")
                            <a href="{{ route('teacher.dashboard') }}" class="text-xl py-6 rounded-lg
        px-3 bg-gray-50 block border border-2 mx-4
                       border-blue-400 text-blue-400 hover:bg-white">
                                پنل معلم
                            </a>
                        @else
                        <a href="{{ route('teacher.login') }}" class="text-xl py-6 rounded-lg
        px-3 bg-gray-50 block border border-2 mx-4
                       border-blue-400 text-blue-400 hover:bg-white">
                            ورود معلم
                        </a>
                        @endauth
                    </div>
                </div>
            </div>
            <div class=" max-w-md border bg-white border-gray-200 rounded-lg ">
                <div class=" md:max-w-lg max-w-md ">
                    <a href="/products?category=cyNjA">
                        <img src="/images/images.jpg" class="rounded-lg " alt="ادوات ">
                    </a>
                    <div class="flex justify-center text-center items-center p-3">
                        <div class="">
                            @auth("student")
                                <a href="{{ route('student.dashboard') }}" class="text-xl py-6 rounded-lg
        px-3 bg-gray-50 block border border-2 mx-4
                       border-blue-400 text-blue-400 hover:bg-white">
                                    پنل دانش آموز
                                </a>
                            @else
                            <a href="{{ route('student.login') }}" class="text-xl py-6 rounded-lg
        px-3 bg-gray-50 block border border-2 mx-4
                       border-blue-400 text-blue-400 hover:bg-white">
                                ورود دانش آموز
                            </a>
                            @endauth
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</main>
</body>
</html>
