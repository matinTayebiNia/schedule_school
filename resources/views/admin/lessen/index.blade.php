<x-admin-layout>

    @can("see-lessens")
        <div
            class="flex flex-wrap w-full  flex-col px-4 py-8 bg-white rounded-lg shadow  sm:px-6 md:px-8 lg:px-10 my-3">
            @if(session("success"))
                <div class="bg-teal-100 border-t-4 border-teal-500 m-3 rounded-b text-teal-900 px-4 py-3 shadow-md"
                     role="alert">
                    <div class="flex gap-4">
                        <div class="py-1">
                            <svg class="fill-current h-6 w-6 text-teal-500 mr-4"
                                 xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <path
                                    d="M2.93 17.07A10 10 0 1 1 17.07 2.93 10 10 0 0 1 2.93 17.07zm12.73-1.41A8 8 0 1 0 4.34 4.34a8 8 0 0 0 11.32 11.32zM9 11V9h2v6H9v-4zm0-6h2v2H9V5z"/>
                            </svg>
                        </div>
                        <div>
                            <p class="font-bold">{{session("success")}}</p>
                        </div>
                    </div>
                </div>
            @endif

            <div class="flex flex-row mb-1 sm:mb-0 justify-between w-full">
                <h2 class="text-2xl leading-tight">
                    {{$title}}
                </h2>
                <div class="text-end">
                    <form
                        action=""
                        class="flex flex-col md:flex-row w-3/4
                    md:w-full max-w-sm md:space-x-3 space-y-3 md:space-y-0 justify-center"
                        method="get">
                        <div class=" relative ">
                            <input type="text" name="search" id="search" value="{{request("search")??""}}" class="rounded-r-lg
                         border-transparent flex-1 appearance-none border border-gray-300
                          w-full py-2 px-4 bg-white text-gray-700 placeholder-gray-400
                           shadow-sm text-base focus:outline-none focus:ring-2
                           focus:ring-purple-600 focus:border-transparent" placeholder="جستجو">
                        </div>
                        <button class="flex-shrink-0 px-4 py-2 text-base
                     font-semibold text-white bg-purple-600 rounded-l-lg
                      shadow-md hover:bg-purple-700 focus:outline-none
                      focus:ring-2 focus:ring-purple-500 focus:ring-offset-2
                      focus:ring-offset-purple-200" type="submit">
                            فیلتر
                        </button>
                    </form>
                </div>
            </div>
            <div class="-mx-4 sm:-mx-8 px-4 sm:px-8 py-4 overflow-x-auto">

                <div class="inline-bloc bg-white min-w-full shadow rounded-lg overflow-hidden">
                    @can("create-lessen")
                        <div class="flex">
                            <a href="{{route("admin.lessen.create")}}"
                               class="p-3 rounded-lg bg-blue-600 hover:bg-blue-800 text-white  mt-9 mr-4 ">
                                ثبت درس جدید</a>
                        </div>
                    @endcan

                    <table class="min-w-full leading-normal">
                        <thead>
                        <tr>
                            <th scope="col"
                                class="px-5 py-3 bg-white  border-b border-gray-200 text-gray-800  text-right text-sm uppercase font-normal">
                                نام درس
                            </th>
                            <th scope="col"
                                class="px-5 py-3 bg-white  border-b border-gray-200 text-gray-800  text-right text-sm uppercase font-normal">
                               کد درس
                            </th>

                            <th scope="col"
                                class="px-5 py-3 bg-white  border-b border-gray-200 text-gray-800  text-right text-sm uppercase font-normal">
                                اقدامات
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($lessens as $lessen)
                            <tr>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                    <p class="text-gray-900 whitespace-no-wrap">
                                        {{$lessen->name}}
                                    </p>
                                </td>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                    <p class="text-gray-900 whitespace-no-wrap">
                                        {{$lessen->code}}
                                    </p>
                                </td>

                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                    <div class="flex gap-2">
                                        @can("update-lessen")
                                            <a href="{{route("admin.lessen.edit",$lessen->id)}}">
                                                <svg xmlns="http://www.w3.org/2000/svg" height="24px"
                                                     viewBox="0 0 24 24"
                                                     width="24px" fill="#F9A602">
                                                    <path d="M0 0h24v24H0V0z" fill="none"></path>
                                                    <path
                                                        d="M14.06 9.02l.92.92L5.92 19H5v-.92l9.06-9.06M17.66 3c-.25 0-.51.1-.7.29l-1.83 1.83 3.75 3.75 1.83-1.83c.39-.39.39-1.02 0-1.41l-2.34-2.34c-.2-.2-.45-.29-.71-.29zm-3.6 3.19L3 17.25V21h3.75L17.81 9.94l-3.75-3.75z"></path>
                                                </svg>
                                            </a>
                                        @endcan
                                        @can("delete-lessen")
                                            <button type="button"
                                                    x-on:click="[showModal=true, target_id='{{$lessen->id}}']"
                                            >
                                                <svg
                                                    xmlns="http://www.w3.org/2000/svg" height="24px"
                                                    viewBox="0 0 24 24"
                                                    width="24px" fill="#FF0000">
                                                    <path d="M0 0h24v24H0V0z" fill="none"></path>
                                                    <path
                                                        d="M16 9v10H8V9h8m-1.5-6h-5l-1 1H5v2h14V4h-3.5l-1-1zM18 7H6v12c0 1.1.9 2 2 2h8c1.1 0 2-.9 2-2V7z"></path>
                                                </svg>
                                            </button>
                                        @endcan


                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    {{$lessens->appends(['search'=>request('search')])->links('layouts.paginate')}}
                </div>
            </div>
        </div>
    @endcan

    @can("delete-lessen")
    <!--Overlay-->
        <div class="overflow-auto" style="background-color: rgba(0,0,0,0.5)" x-show="showModal"
             :class="{ 'absolute inset-0 z-10 flex items-center justify-center': showModal }">
            <!--Dialog-->
            <div class="bg-white w-11/12 md:max-w-md mx-auto rounded shadow-lg py-4 text-left px-6"
                 @click.away="showModal = false"
                 x-transition:enter="ease-out duration-300"
                 x-transition:enter-start="opacity-0 scale-90"
                 x-transition:enter-end="opacity-100 scale-100">

                <!--Title-->
                <div x-show="showModal" class="flex justify-between items-center pb-3">
                    <p class="text-2xl font-bold">حذف درس!</p>
                    <div class="cursor-pointer z-50" @click="showModal = false">
                        <svg class="fill-current text-black" xmlns="http://www.w3.org/2000/svg"
                             width="18"
                             height="18" viewBox="0 0 18 18">
                            <path
                                d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z"></path>
                        </svg>
                    </div>
                </div>
                <form action="{{route("admin.lessen.destroy")}}" method="post" class="my-2">
                    @method("DELETE")
                    @csrf
                    <input type="hidden" name="lessen_id" :value="$data.target_id">


                    <!-- content -->

                    <p>ایا از حذف درس مورد نظر مطمئن هستید</p>

                    <!--Footer-->
                    <div x-show="showModal" class="flex justify-end pt-2">
                        <button type="submit"
                                class="px-4 bg-transparent p-3 rounded-lg text-indigo-500 hover:bg-gray-100 hover:text-indigo-400 mr-2"
                        >حذف کن
                        </button>
                        <button type="button"
                                class="modal-close px-4 bg-indigo-500 p-3 rounded-lg text-white hover:bg-indigo-400"
                                @click="showModal = false">انصراف
                        </button>
                    </div>
                </form>
            </div>
        </div>
    @endcan

</x-admin-layout>
