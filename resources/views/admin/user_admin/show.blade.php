<x-admin-layout>
    @can("see-teacher")
        <div
            class="flex flex-wrap w-full  flex-col bg-white rounded-lg shadow  sm:px-6 md:px-8 lg:px-10 ">

            <div class="flex flex-row mb-1 sm:mb-0 justify-between w-full">
                <div class="p-16">
                    <div class="bg-white shadow mt-24">
                        <div class="flex flex-col md:flex-row items-center gap-4">

                            <div class="relative">
                                <div
                                    class="w-48 h-48 bg-indigo-100 mx-auto rounded-full
                                     shadow-2xl  flex items-center justify-center text-indigo-500">
                                    @if($user->profile_image)
                                        <img src="{{$user->profile_image}}" class="rounded-full w-[75%] h-[75%]" alt="{{$user->family}}">
                                    @else
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-24 w-24" viewBox="0 0 20 20"
                                             fill="currentColor">
                                            <path fill-rule="evenodd"
                                                  d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
                                                  clip-rule="evenodd"/>
                                        </svg>
                                    @endif
                                </div>
                            </div>
                            <div class="mt-20 text-right border-b w-full pb-12"><h1
                                    class="text-4xl font-medium text-gray-700">
                                    {{$user->name ." ".$user->family}} </h1>
                                <p class="font-light text-gray-600 mt-3">کد ملی : {{$user->personal_code}}</p>
                                <p class="mt-3 text-gray-500">تلفن همراه:{{$user->phone}}</p>
                            </div>

                        </div>
                        <div class="mt-12 flex flex-col justify-center">

                            <p class="text-gray-600 text-center font-light lg:px-16">
                                <span>آدرس:</span> {{$user->address}}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endcan
</x-admin-layout>
