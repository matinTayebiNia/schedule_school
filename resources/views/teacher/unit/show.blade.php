<x-teacher-layout>
    <section class=" bg-stone-50 xl:h-screen font-poppins">
        <div class="flex items-center xl:h-screen  ">
            <div class="justify-center flex-1 max-w-6xl py-4 mx-auto lg:py-6 md:px-6">
                <div class="flex flex-wrap items-center ">
                    <div class="w-full px-4 mb-10 lg:w-1/2 lg:mb-0">
                        <div class="lg:max-w-md">
                        <span class="text-xl font-semibold text-purple-600 uppercase ">
                           مشخصات واحد</span>
                            <h2 class="mt-4 mb-6 text-2xl font-bold">
                                ظرفیت دانشجو:{{$unit->student_limit}}</h2>
                            <p class="mb-10 text-gray-600 ">
                                <span>زور برگذاری</span>:<span>{{$unit->convertToPersianDay()}}</span>
                                <br>
                                <span>زمان شروع</span>:<span>{{$unit->start_time}}</span>
                                <br>
                                <span>زمان پایان</span>:<span>{{$unit->end_time}}</span>

                            </p>
                        </div>
                    </div>
                    <div class="w-full px-4 mb-10 lg:w-1/2 lg:mb-0">
                        <div class="flex mb-4 gap-1">
                        <span
                            class="flex items-center justify-center text-white flex-shrink-0 w-12 h-12 mr-6 bg-purple-500 rounded ">
                      <svg xmlns="http://www.w3.org/2000/svg" class="svg-icon"
                           style="width: 2em; height: 2em;vertical-align: middle;fill: currentColor;overflow: hidden;"
                           viewBox="0 0 1024 1024" version="1.1"><path
                              d="M362.846102 512a13.536866 13.536866 0 0 0 13.536865-13.536866v-54.147463a13.536866 13.536866 0 0 0-27.073731 0v54.147463a13.536866 13.536866 0 0 0 13.536866 13.536866zM660.657148 512a13.536866 13.536866 0 0 0 13.536866-13.536866v-54.147463a13.536866 13.536866 0 0 0-27.073732 0v54.147463a13.536866 13.536866 0 0 0 13.536866 13.536866z"/><path
                              d="M994.476258 660.905523l-103.692392 44.40092v-71.474651l73.64055-36.820275a13.536866 13.536866 0 0 0 7.580644-12.183179v-140.512667a13.536866 13.536866 0 0 0-13.536865-13.536866h-67.684329V177.910153a27.073732 27.073732 0 0 0-16.514976-24.907833l-351.95851-150.800684a27.073732 27.073732 0 0 0-21.388248 0l-351.958509 150.800684a27.073732 27.073732 0 0 0-16.514976 24.907833v252.868652H65.035055a13.536866 13.536866 0 0 0-13.536866 13.536866v140.512667a13.536866 13.536866 0 0 0 7.580645 12.183179l73.64055 36.820275v71.474651L29.026992 660.905523a13.536866 13.536866 0 0 0-17.597925 17.868663l90.155526 202.782249a13.536866 13.536866 0 0 0 14.349077 7.851382l57.667048-8.122119 327.862889 140.512666a27.073732 27.073732 0 0 0 21.388248 0l327.321414-140.783404 56.313361 7.851382a13.536866 13.536866 0 0 0 14.890553-7.851382l91.238475-202.240774a13.536866 13.536866 0 0 0-18.1394-17.868663z m-49.544929-203.052986v118.582944l-54.147463 27.073731v-145.656675zM511.751625 27.109469l351.958509 150.800684v90.426263H476.285037l-175.708518-150.800684z m-433.179704 549.326012v-118.582944h54.147463v145.656675z m81.221194 49.003454v-226.065658l126.975801-49.815666a13.536866 13.536866 0 0 0-10.01728-25.17857l-116.958521 45.754606v-51.981565l126.975801-49.815666a13.536866 13.536866 0 0 0-10.01728-25.17857l-116.958521 45.754606v-111.002299L272.690576 129.448174l193.306443 165.961974h397.713115v421.537999l-19.493086 8.392857a13.536866 13.536866 0 0 1-14.078341-2.165898l-152.425108-126.975801a13.536866 13.536866 0 0 0-8.663594-3.248848h-97.465433a13.536866 13.536866 0 0 0-9.475806 4.06106l-40.610598 40.610597a13.536866 13.536866 0 0 1-19.222349 0l-40.610597-40.610597a13.536866 13.536866 0 0 0-9.475806-4.06106h-98.006908a13.536866 13.536866 0 0 0-8.663594 3.248848l-152.154372 126.975801a13.536866 13.536866 0 0 1-14.07834 2.165898l-19.493087-8.392857z m351.95851 371.451596l-286.981554-122.914741 66.059905-10.01728a13.536866 13.536866 0 0 0 7.580645-3.790323l95.570272-95.570272a13.536866 13.536866 0 0 1 19.222349 0l89.072577 89.072577a13.536866 13.536866 0 0 0 19.222349 0l90.967738-90.967738a13.536866 13.536866 0 0 1 17.056451-1.624424l96.923959 100.714281a13.536866 13.536866 0 0 0 4.873271 1.895161l67.955066 9.475806z m394.464268-146.468887a13.536866 13.536866 0 0 1-14.890552 7.851382l-149.446998-19.222349a13.536866 13.536866 0 0 1-4.873272-1.895162l-101.526493-103.963129a27.073732 27.073732 0 0 0-34.112902 3.248848l-79.59677 79.596771a13.536866 13.536866 0 0 1-19.22235 0l-79.59677-79.596771a27.073732 27.073732 0 0 0-38.173962 0l-98.81912 98.81912a13.536866 13.536866 0 0 1-7.580645 3.790323l-145.656675 20.846773a13.536866 13.536866 0 0 1-14.349078-7.851382l-67.684329-152.425109 126.163589 54.147463a27.073732 27.073732 0 0 0 27.073732-4.061059l151.071422-125.892852a13.536866 13.536866 0 0 1 7.851382-3.519585h76.889397a13.536866 13.536866 0 0 1 9.475806 4.06106l42.235021 42.235021a27.073732 27.073732 0 0 0 38.173962 0l42.235021-42.235021a13.536866 13.536866 0 0 1 9.475806-4.06106h79.326033a13.536866 13.536866 0 0 1 8.663594 3.248848l151.071422 125.892851a27.073732 27.073732 0 0 0 27.073732 4.06106l126.163588-54.147463z"/></svg>
                        </span>
                            <div>
                                <h2 class="mb-4 text-xl font-bold leading-tight  md:text-2xl">
                                    استاد مربوطه
                                </h2>
                                <p class="text-base leading-loose text-gray-500 ">
                                    {{$unit->teacher->name." ".$unit->teacher->family}}
                                </p>
                            </div>
                        </div>
                        <div class="flex mb-4 gap-1">
                        <span
                            class="flex items-center justify-center flex-shrink-0 w-12 h-12 mr-6 bg-purple-500 rounded text-gray-50">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                 class="w-5 h-5 bi bi-file-text" viewBox="0 0 16 16">
                                <path
                                    d="M5 4a.5.5 0 0 0 0 1h6a.5.5 0 0 0 0-1H5zm-.5 2.5A.5.5 0 0 1 5 6h6a.5.5 0 0 1 0 1H5a.5.5 0 0 1-.5-.5zM5 8a.5.5 0 0 0 0 1h6a.5.5 0 0 0 0-1H5zm0 2a.5.5 0 0 0 0 1h3a.5.5 0 0 0 0-1H5z"/>
                                <path
                                    d="M2 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2zm10-1H4a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1z"/>
                            </svg>
                        </span>
                            <div>
                                <h2 class="mb-4 text-xl font-bold leading-tight  md:text-2xl">
                                    درس
                                </h2>
                                <p class="text-base leading-loose text-gray-500 ">
                                    {{$unit->lessen->name}}({{$unit->lessen->code}})
                                </p>
                            </div>
                        </div>
                        <div class="flex gap-1 mb-4">
                        <span
                            class="flex items-center justify-center flex-shrink-0 w-12 h-12 mr-6 bg-purple-500 rounded text-gray-50">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                 class="w-5 h-5 bi bi-bank2" viewBox="0 0 16 16">
                                <path
                                    d="M8.277.084a.5.5 0 0 0-.554 0l-7.5 5A.5.5 0 0 0 .5 6h1.875v7H1.5a.5.5 0 0 0 0 1h13a.5.5 0 1 0 0-1h-.875V6H15.5a.5.5 0 0 0 .277-.916l-7.5-5zM12.375 6v7h-1.25V6h1.25zm-2.5 0v7h-1.25V6h1.25zm-2.5 0v7h-1.25V6h1.25zm-2.5 0v7h-1.25V6h1.25zM8 4a1 1 0 1 1 0-2 1 1 0 0 1 0 2zM.5 15a.5.5 0 0 0 0 1h15a.5.5 0 1 0 0-1H.5z">
                                </path>
                            </svg>
                        </span>
                            <div>
                                <h2 class="mb-4 text-xl font-bold leading-tight md:text-2xl">
                                    دانشگاه
                                </h2>
                                <p class="text-base leading-loose text-gray-500 ">
                                    {{$unit->class->school->name}}({{$unit->class->name}})
                                </p>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div class="bg-stone-50  p-4">
            <div class="text-right text-2xl">
                <h1>دانش آموزان</h1>
            </div>
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
                </tr>
                </thead>
                <tbody>
                @if($unit->students->count()>0)
                @foreach($unit->students as $student)
                    <tr>
                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                            <p class="text-gray-900 whitespace-no-wrap">
                                {{$student->name}}
                            </p>
                        </td>
                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                            <p class="text-gray-900 whitespace-no-wrap">
                                {{$student->family}}
                            </p>
                        </td>
                    </tr>
                @endforeach
                @else
                    <tr>
                        <td colspan="2" class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                            <p class="text-gray-900 whitespace-no-wrap">
                                <span>دانش آموزی برای واحد مورد نظر ثبت نشده</span>
                            </p>
                        </td>
                    </tr>
                @endif
                </tbody>
            </table>
        </div>
    </section>
</x-teacher-layout>
