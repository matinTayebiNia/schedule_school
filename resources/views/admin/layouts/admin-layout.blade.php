<!doctype html>
<html lang="fa">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{$title ?? env("APP_NAME")}}</title>
    <link rel="stylesheet" href="{{asset("/app.css")}}">
    <link href="{{asset("/assets/css/plugins/select2.min.css")}}" rel="stylesheet"/>
    @livewireStyles

</head>
<body dir="rtl" class="bg-gray-100 rounded-2xl h-screen relative font-body">
<div class="flex items-start justify-between">

    <x-side-bar-admin-layout>

    </x-side-bar-admin-layout>

    <div class="flex flex-col w-full pl-0 md:p-4 md:space-y-4">
        <!-- Header -->
        <header class="w-full shadow-lg bg-white  items-center h-16 rounded-2xl z-40">
            <div class="relative z-20 flex flex-col justify-center h-full px-3 mx-auto flex-center">
                <div class="relative items-center pl-1 flex w-full lg:max-w-68 sm:pr-2 sm:ml-0">
                    <div class="container relative left-0 z-50 flex w-3/4 h-auto h-full">
                        <div class="relative flex items-center w-full lg:w-64 h-full group">
                            <div
                                class="absolute z-50 flex items-center justify-center block w-auto h-10 p-3 pr-2 text-sm text-gray-500  cursor-pointer sm:hidden">
                                <svg fill="none" class="relative w-5 h-5" stroke-linecap="round" stroke-linejoin="round"
                                     stroke-width="2" stroke="currentColor" viewBox="0 0 24 24">
                                    <path d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z">
                                    </path>
                                </svg>
                            </div>
                            <svg
                                class="absolute right-0 z-20 hidden w-4 h-4 mr-4 text-gray-500 pointer-events-none fill-current group-hover:text-gray-400 sm:block"
                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <path
                                    d="M12.9 14.32a8 8 0 1 1 1.41-1.41l5.35 5.33-1.42 1.42-5.33-5.34zM8 14A6 6 0 1 0 8 2a6 6 0 0 0 0 12z">
                                </path>
                            </svg>
                            <input type="text"
                                   class="block w-full py-1.5 pr-10 pl-4 leading-normal rounded-2xl focus:border-transparent focus:outline-none focus:ring-2 focus:ring-blue-500 ring-opacity-90 bg-gray-100 text-gray-400 aa-input"
                                   placeholder="جستجو">
                        </div>
                    </div>
                    <div class="relative p-1 flex items-center justify-end w-1/4 ml-5 mr-4 sm:mr-0 sm:right-auto">
                        <a href="#" id="dropdownInformationButton" class="block relative">
                            <img alt="profil" src="{{asset("images/man.png")}}"
                                 class="mx-auto object-cover rounded-full h-10 w-10 ">
                        </a>
                    </div>
                </div>
            </div>
            <div class=" flex justify-end ">
                <div id="dropdownInformation"
                     class="hidden z-10 w-32 bg-white rounded divide-y divide-gray-100 shadow ">
                    <!--   <div class="py-3 px-4 text-sm text-gray-900">
                           <div>Bonnie Green</div>
                           <div class="font-medium truncate">name@flowbite.com</div>
                       </div>
                       <ul class="py-1 text-sm text-gray-700 " aria-labelledby="dropdownInformationButton">
                           <li>
                               <a href="#" class="block py-2 px-4 hover:bg-gray-100 ">Dashboard</a>
                           </li>
                           <li>
                               <a href="#" class="block py-2 px-4 hover:bg-gray-100 ">Settings</a>
                           </li>
                           <li>
                               <a href="#" class="block py-2 px-4 hover:bg-gray-100 ">Earnings</a>
                           </li>
                       </ul>
                     -->
                    <div class="py-1">
                        <a href="#" class="block py-2 px-4 text-sm text-gray-700 hover:bg-gray-100 ">
                            ویرایش اطلاعات
                        </a>
                    </div>
                    <div class="py-1">
                        <a href="#"
                           onclick="event.preventDefault();document.getElementById('logout-form').submit();"
                           class="block py-2 px-4 text-sm text-gray-700 hover:bg-gray-100 ">خروج</a>
                    </div>

                </div>
            </div>
            <form action="{{route("logout")}}" method="post" id="logout-form">
                @csrf
            </form>

        </header>

        <div class="overflow-auto  h-screen pb-24 pt-2 pr-2 pl-2 md:pt-0 md:pr-0 md:pl-0">
            {!! $slot !!}
        </div>
    </div>

</div>
@yield("script")
@livewireScript
</body>
</html>
