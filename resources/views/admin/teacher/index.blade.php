<x-admin-layout>

    @can("see-teachers")
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
                            <input type="text" name="search" id="search" class="rounded-r-lg
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
                </div>
            </div>
            <div class="-mx-4 sm:-mx-8 px-4 sm:px-8 py-4 overflow-x-auto">

                <div class="inline-bloc bg-white min-w-full shadow rounded-lg overflow-hidden">


                    <table class="min-w-full leading-normal">
                        <thead>
                        <tr>
                            <th scope="col"
                                class="px-5 py-3 bg-white  border-b border-gray-200 text-gray-800  text-right text-sm uppercase font-normal">
                                نام
                            </th>
                            <th scope="col"
                                class="px-5 py-3 bg-white  border-b border-gray-200 text-gray-800  text-right text-sm uppercase font-normal">
                                نام خانوادگی
                            </th>
                            <th scope="col"
                                class="px-5 py-3 bg-white  border-b border-gray-200 text-gray-800  text-right text-sm uppercase font-normal">
                                شماره تلفن
                            </th>
                            <th scope="col"
                                class="px-5 py-3 bg-white  border-b border-gray-200 text-gray-800  text-right text-sm uppercase font-normal">
                                کد ملی
                            </th>
                            <th scope="col"
                                class="px-5 py-3 bg-white  border-b border-gray-200 text-gray-800  text-right text-sm uppercase font-normal">
                                اقدامات
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($teachers as $teacher)
                            <tr>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                    <p class="text-gray-900 whitespace-no-wrap">
                                        {{$teacher->name}}
                                    </p>
                                </td>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                    <p class="text-gray-900 whitespace-no-wrap">
                                        {{$teacher->family}}
                                    </p>
                                </td>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                    <p class="text-gray-900 whitespace-no-wrap">
                                        {{$teacher->phone}}
                                    </p>
                                </td>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                    <p class="text-gray-900 whitespace-no-wrap">
                                        {{$teacher->personal_code}}
                                    </p>
                                </td>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                    <div class="flex">
                                        @can("edit-teacher")
                                            <a href="{{route("admin.teacher.edit",$teacher->id)}}">
                                                <svg xmlns="http://www.w3.org/2000/svg" height="24px"
                                                     viewBox="0 0 24 24"
                                                     width="24px" fill="#F9A602">
                                                    <path d="M0 0h24v24H0V0z" fill="none"></path>
                                                    <path
                                                        d="M14.06 9.02l.92.92L5.92 19H5v-.92l9.06-9.06M17.66 3c-.25 0-.51.1-.7.29l-1.83 1.83 3.75 3.75 1.83-1.83c.39-.39.39-1.02 0-1.41l-2.34-2.34c-.2-.2-.45-.29-.71-.29zm-3.6 3.19L3 17.25V21h3.75L17.81 9.94l-3.75-3.75z"></path>
                                                </svg>
                                            </a>
                                        @endcan

                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                    {{$categories->links("layouts.paginate")}}
                </div>

                <!--Modal-->
                @can("delete-category")

                    <div class="modal opacity-0 pointer-events-none
                     fixed w-full h-full top-0 left-0 flex items-center justify-center">
                        <div class="modal-overlay absolute w-full h-full bg-gray-900 opacity-50"></div>

                        <div
                            class="modal-container bg-white w-11/12 md:max-w-md mx-auto rounded shadow-lg z-50 overflow-y-auto">

                            <div
                                class="modal-close absolute top-0 right-0 cursor-pointer flex flex-col items-center mt-4 mr-4 text-white text-sm z-50">
                                <svg class="fill-current text-white" xmlns="http://www.w3.org/2000/svg" width="18"
                                     height="18" viewBox="0 0 18 18">
                                    <path
                                        d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z"></path>
                                </svg>
                                <span class="text-sm">(خروج)</span>
                            </div>

                            <!-- Add margin if you want to see some of the overlay behind the modal-->
                            <div class="modal-content py-4 text-left px-6">
                                <!--Title-->
                                <div class="flex justify-between items-center pb-3">
                                    <p id="title-modal" class="text-2xl font-bold"></p>
                                    <div class="modal-close cursor-pointer z-50">
                                        <svg class="fill-current text-black" xmlns="http://www.w3.org/2000/svg"
                                             width="18"
                                             height="18" viewBox="0 0 18 18">
                                            <path
                                                d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z"></path>
                                        </svg>
                                    </div>
                                </div>
                                <form method="post">
                                    <!--Body-->
                                    <p id="text-detail" class="text-right"></p>
                                    <!--Footer-->
                                    <div class="flex justify-end pt-2">

                                        <button type="button"
                                                class="modal-close px-4 bg-indigo-500 p-3 rounded-lg text-white hover:bg-indigo-400">
                                            انصراف
                                        </button>

                                        <button type="submit"
                                                class="px-4 bg-transparent p-3 rounded-lg text-indigo-500 hover:bg-gray-100 hover:text-indigo-400 mr-2">
                                            <span>حذف</span>

                                            <svg aria-hidden="true" wire:loading
                                                 id="loading-delete"
                                                 class="inline w-4 h-4 mr-3 text-indigo-500 animate-spin"
                                                 viewBox="0 0 100 101"
                                                 fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
                                                    fill="#E5E7EB"/>
                                                <path
                                                    d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
                                                    fill="currentColor"/>
                                            </svg>

                                        </button>
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>
                @endcan
            </div>
        </div>
    @endcan

</x-admin-layout>
