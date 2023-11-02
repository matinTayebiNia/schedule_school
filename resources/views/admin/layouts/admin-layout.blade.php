<!doctype html>
<html lang="fa">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset("/css/app.css")}}">
    <link href="{{asset("/plugins/css/select2.min.css")}}" rel="stylesheet"/>
    @livewireStyles
    <title>{{$title ?? env("APP_NAME")}}</title>

    <link rel="stylesheet" href="{{ asset('vendor/file-manager/css/file-manager.css') }}">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

</head>
<body x-data="{ 'showModal': false,target_id:0 }" @keydown.escape="showModal = false" dir="rtl"
      class="bg-gray-100 rounded-2xl h-screen relative font-body">
<div class="flex items-start justify-between">

    <x-side-bar-admin-layout>
        @can("see-teachers")
            <x-SidebarAdminItem :route="route('admin.teacher.index')" itemName="معلمان"
                                :isActive="isActive(['admin.teacher.index','admin.teacher.show','admin.teacher.create','admin.teacher.edit'])"
                                icon='<svg xmlns="http://www.w3.org/2000/svg" id="Layer_1" data-name="Layer 1" viewBox="0 0 122.88 79.13"><defs><style>.cls-1{fill-rule:evenodd;}</style></defs><title>users</title><path class="cls-1" d="M72.74,51.34A11.29,11.29,0,0,1,67.43,48c3.55-1.34,5.2-4.93,5.42-11.22.17-4.68-.79-8.2.8-12.81C76.8,14.82,88.48,11.7,95,17.05c5.1-.55,10.24,2.08,11.35,10,.82,5.86-.93,11,.92,16.4a8.41,8.41,0,0,0,4.35,5.15,12.65,12.65,0,0,1-5.81,2.8,59.57,59.57,0,0,1-9.17,1v2.76l3.19,5.1-10.3,8.07-10.3-8,2.29-4.9v-3a39.86,39.86,0,0,1-8.76-1.1ZM29,53.86a7.58,7.58,0,0,1,.79-2.76c-2.26-2-4-4-4.42-8.19h-.24a3.35,3.35,0,0,1-1.6-.42,4.34,4.34,0,0,1-1.76-2.14c-.82-1.87-1.46-6.78.59-8.18L22,31.92l0-.55c-.08-1-.1-2.18-.12-3.44-.07-4.61-.17-10.2-3.88-11.33l-1.59-.48,1.05-1.29a60.37,60.37,0,0,1,9.29-9.44C30.23,2.58,33.87.7,37.42.16A13,13,0,0,1,47.89,3.09,20.24,20.24,0,0,1,50.7,5.91a11.86,11.86,0,0,1,8.37,4.9,17,17,0,0,1,2.73,5.5,18.78,18.78,0,0,1,.73,6.24,15,15,0,0,1-4.34,10.12,3.11,3.11,0,0,1,1.35.35c1.55.83,1.6,2.62,1.19,4.13-.4,1.26-.91,2.73-1.39,4-.59,1.66-1.44,2-3.1,1.79-.08,4.1-2,6.11-4.53,8.52l.58,2c-1.61,7.8-18.69,8.65-23.31.43ZM0,79.13C1.62,58.19,5.56,66,23.42,54.86c4.93,12.8,28.6,13.65,33.79,0,15.42,9.85,23.11,2.41,23,24.27ZM105.69,64.61c-1.69-3.4-2.27-4.71-4.76-7.42,4.7,1.83,8.71,2.06,12.27,4.29,2.27,1.42,5.63,2.49,6.55,4.21,2.26,4.23,1.92,8.94,3.13,13.44H86.26a70.42,70.42,0,0,0-.41-8.56l3.39,2.71,11.55-8.79,4.9.12ZM77.93,57.26l.17-.07L78,57.3l-.08,0Z"/></svg>'></x-SidebarAdminItem>
        @endcan
        @can("see-students")
            <x-SidebarAdminItem :route="route('admin.student.index')" itemName="دانش آموزان"
                                :isActive="isActive(['admin.student.index','admin.student.show','admin.student.create','admin.student.edit'])"
                                icon='<svg xmlns="http://www.w3.org/2000/svg" id="Layer_1" data-name="Layer 1" viewBox="0 0 122.88 79.13"><defs><style>.cls-1{fill-rule:evenodd;}</style></defs><title>users</title><path class="cls-1" d="M72.74,51.34A11.29,11.29,0,0,1,67.43,48c3.55-1.34,5.2-4.93,5.42-11.22.17-4.68-.79-8.2.8-12.81C76.8,14.82,88.48,11.7,95,17.05c5.1-.55,10.24,2.08,11.35,10,.82,5.86-.93,11,.92,16.4a8.41,8.41,0,0,0,4.35,5.15,12.65,12.65,0,0,1-5.81,2.8,59.57,59.57,0,0,1-9.17,1v2.76l3.19,5.1-10.3,8.07-10.3-8,2.29-4.9v-3a39.86,39.86,0,0,1-8.76-1.1ZM29,53.86a7.58,7.58,0,0,1,.79-2.76c-2.26-2-4-4-4.42-8.19h-.24a3.35,3.35,0,0,1-1.6-.42,4.34,4.34,0,0,1-1.76-2.14c-.82-1.87-1.46-6.78.59-8.18L22,31.92l0-.55c-.08-1-.1-2.18-.12-3.44-.07-4.61-.17-10.2-3.88-11.33l-1.59-.48,1.05-1.29a60.37,60.37,0,0,1,9.29-9.44C30.23,2.58,33.87.7,37.42.16A13,13,0,0,1,47.89,3.09,20.24,20.24,0,0,1,50.7,5.91a11.86,11.86,0,0,1,8.37,4.9,17,17,0,0,1,2.73,5.5,18.78,18.78,0,0,1,.73,6.24,15,15,0,0,1-4.34,10.12,3.11,3.11,0,0,1,1.35.35c1.55.83,1.6,2.62,1.19,4.13-.4,1.26-.91,2.73-1.39,4-.59,1.66-1.44,2-3.1,1.79-.08,4.1-2,6.11-4.53,8.52l.58,2c-1.61,7.8-18.69,8.65-23.31.43ZM0,79.13C1.62,58.19,5.56,66,23.42,54.86c4.93,12.8,28.6,13.65,33.79,0,15.42,9.85,23.11,2.41,23,24.27ZM105.69,64.61c-1.69-3.4-2.27-4.71-4.76-7.42,4.7,1.83,8.71,2.06,12.27,4.29,2.27,1.42,5.63,2.49,6.55,4.21,2.26,4.23,1.92,8.94,3.13,13.44H86.26a70.42,70.42,0,0,0-.41-8.56l3.39,2.71,11.55-8.79,4.9.12ZM77.93,57.26l.17-.07L78,57.3l-.08,0Z"/></svg>'></x-SidebarAdminItem>
        @endcan
        @can("see-lessens")
            <x-SidebarAdminItem :route="route('admin.lessen.index')" itemName="درس ها"
                                :isActive="isActive(['admin.lessen.index','admin.lessen.create','admin.lessen.edit'])"
                                icon='<svg xmlns="http://www.w3.org/2000/svg" id="Layer_1" data-name="Layer 1" viewBox="0 0 122.88 79.13"><defs><style>.cls-1{fill-rule:evenodd;}</style></defs><title>users</title><path class="cls-1" d="M72.74,51.34A11.29,11.29,0,0,1,67.43,48c3.55-1.34,5.2-4.93,5.42-11.22.17-4.68-.79-8.2.8-12.81C76.8,14.82,88.48,11.7,95,17.05c5.1-.55,10.24,2.08,11.35,10,.82,5.86-.93,11,.92,16.4a8.41,8.41,0,0,0,4.35,5.15,12.65,12.65,0,0,1-5.81,2.8,59.57,59.57,0,0,1-9.17,1v2.76l3.19,5.1-10.3,8.07-10.3-8,2.29-4.9v-3a39.86,39.86,0,0,1-8.76-1.1ZM29,53.86a7.58,7.58,0,0,1,.79-2.76c-2.26-2-4-4-4.42-8.19h-.24a3.35,3.35,0,0,1-1.6-.42,4.34,4.34,0,0,1-1.76-2.14c-.82-1.87-1.46-6.78.59-8.18L22,31.92l0-.55c-.08-1-.1-2.18-.12-3.44-.07-4.61-.17-10.2-3.88-11.33l-1.59-.48,1.05-1.29a60.37,60.37,0,0,1,9.29-9.44C30.23,2.58,33.87.7,37.42.16A13,13,0,0,1,47.89,3.09,20.24,20.24,0,0,1,50.7,5.91a11.86,11.86,0,0,1,8.37,4.9,17,17,0,0,1,2.73,5.5,18.78,18.78,0,0,1,.73,6.24,15,15,0,0,1-4.34,10.12,3.11,3.11,0,0,1,1.35.35c1.55.83,1.6,2.62,1.19,4.13-.4,1.26-.91,2.73-1.39,4-.59,1.66-1.44,2-3.1,1.79-.08,4.1-2,6.11-4.53,8.52l.58,2c-1.61,7.8-18.69,8.65-23.31.43ZM0,79.13C1.62,58.19,5.56,66,23.42,54.86c4.93,12.8,28.6,13.65,33.79,0,15.42,9.85,23.11,2.41,23,24.27ZM105.69,64.61c-1.69-3.4-2.27-4.71-4.76-7.42,4.7,1.83,8.71,2.06,12.27,4.29,2.27,1.42,5.63,2.49,6.55,4.21,2.26,4.23,1.92,8.94,3.13,13.44H86.26a70.42,70.42,0,0,0-.41-8.56l3.39,2.71,11.55-8.79,4.9.12ZM77.93,57.26l.17-.07L78,57.3l-.08,0Z"/></svg>'></x-SidebarAdminItem>
        @endcan

        @can("see-schools")
            <x-SidebarAdminItem :route="route('admin.school.index')" itemName="مدارس"
                                :isActive="isActive(['admin.school.index','admin.school.show','admin.school.create','admin.school.edit'])"
                                icon='<svg xmlns="http://www.w3.org/2000/svg" id="Layer_1" data-name="Layer 1" viewBox="0 0 122.88 79.13"><defs><style>.cls-1{fill-rule:evenodd;}</style></defs><title>users</title><path class="cls-1" d="M72.74,51.34A11.29,11.29,0,0,1,67.43,48c3.55-1.34,5.2-4.93,5.42-11.22.17-4.68-.79-8.2.8-12.81C76.8,14.82,88.48,11.7,95,17.05c5.1-.55,10.24,2.08,11.35,10,.82,5.86-.93,11,.92,16.4a8.41,8.41,0,0,0,4.35,5.15,12.65,12.65,0,0,1-5.81,2.8,59.57,59.57,0,0,1-9.17,1v2.76l3.19,5.1-10.3,8.07-10.3-8,2.29-4.9v-3a39.86,39.86,0,0,1-8.76-1.1ZM29,53.86a7.58,7.58,0,0,1,.79-2.76c-2.26-2-4-4-4.42-8.19h-.24a3.35,3.35,0,0,1-1.6-.42,4.34,4.34,0,0,1-1.76-2.14c-.82-1.87-1.46-6.78.59-8.18L22,31.92l0-.55c-.08-1-.1-2.18-.12-3.44-.07-4.61-.17-10.2-3.88-11.33l-1.59-.48,1.05-1.29a60.37,60.37,0,0,1,9.29-9.44C30.23,2.58,33.87.7,37.42.16A13,13,0,0,1,47.89,3.09,20.24,20.24,0,0,1,50.7,5.91a11.86,11.86,0,0,1,8.37,4.9,17,17,0,0,1,2.73,5.5,18.78,18.78,0,0,1,.73,6.24,15,15,0,0,1-4.34,10.12,3.11,3.11,0,0,1,1.35.35c1.55.83,1.6,2.62,1.19,4.13-.4,1.26-.91,2.73-1.39,4-.59,1.66-1.44,2-3.1,1.79-.08,4.1-2,6.11-4.53,8.52l.58,2c-1.61,7.8-18.69,8.65-23.31.43ZM0,79.13C1.62,58.19,5.56,66,23.42,54.86c4.93,12.8,28.6,13.65,33.79,0,15.42,9.85,23.11,2.41,23,24.27ZM105.69,64.61c-1.69-3.4-2.27-4.71-4.76-7.42,4.7,1.83,8.71,2.06,12.27,4.29,2.27,1.42,5.63,2.49,6.55,4.21,2.26,4.23,1.92,8.94,3.13,13.44H86.26a70.42,70.42,0,0,0-.41-8.56l3.39,2.71,11.55-8.79,4.9.12ZM77.93,57.26l.17-.07L78,57.3l-.08,0Z"/></svg>'></x-SidebarAdminItem>
        @endcan
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
<script src="{{asset("/plugins/js/jquery-3.6.0.min.js")}}"></script>
<script src="{{asset("/plugins/js/select2.min.js")}}"></script>
<script src="{{ asset('vendor/file-manager/js/file-manager.js') }}"></script>
<script>
    document.getElementById("dropdownInformationButton").addEventListener("click", function (e) {
        let alert = document.getElementById("dropdownInformation");
        e.preventDefault();
        if (alert.classList.contains("hidden")) {
            alert.classList.remove("hidden");
        } else {
            alert.classList.add("hidden");
        }
    })

    window.selectedTwo = () => {
        $('.js-example-basic-single').select2();
    }
</script>
@yield("script")
@livewireScripts
</body>
</html>
