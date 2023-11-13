<x-teacher-layout>

    <div class="-mx-4 sm:-mx-8 px-4 sm:px-8 py-4 overflow-x-auto">
        <div class="inline-bloc bg-white min-w-full shadow rounded-lg overflow-hidden">
            <div class="flex flex-row mb-1 p-4 sm:mb-0 justify-between w-full">
                <h2 class="text-2xl leading-tight">
                    {{$title}}
                </h2>
            </div>
            <div class="p-6 mt-8">
                <div class="w-full rounded-lg block">
                    <form action="{{route("teacher.profile.update")}}" method="post" class=" w-full ">
                        @csrf
                        @method("PATCH")
                        <div class="relative">
                            <x-label-input-dashboard for="name" label="نام:"></x-label-input-dashboard>
                            <x-input-dashboard :value="$user->name" name="name" placeholder="نام را وارد کنید">
                            </x-input-dashboard>
                            <x-error-input-dashboard name="name">
                            </x-error-input-dashboard>
                        </div>
                        <div class="relative">
                            <x-label-input-dashboard for="family" label="نام خانوادگی:"></x-label-input-dashboard>
                            <x-input-dashboard :value="$user->family" name="family"
                                               placeholder="نام خانوادگی را وارد کنید"></x-input-dashboard>
                            <x-error-input-dashboard name="family"></x-error-input-dashboard>
                        </div>
                        <div class="relative">
                            <x-label-input-dashboard for="phone" label="شماره تلفن:"></x-label-input-dashboard>
                            <x-input-dashboard :value="$user->phone" name="phone"
                                               placeholder="شماره تلفن را وارد کنید"></x-input-dashboard>
                            <x-error-input-dashboard name="phone"></x-error-input-dashboard>
                        </div>
                        <div class="relative">
                                   <span class="input-group-btn">
                                     <a id="lfm" data-input="thumbnail" data-preview="holder" class="flex-shrink-0 px-4 py-2 text-base
                     font-semibold text-white bg-purple-600 rounded-r-lg
                      shadow-md hover:bg-purple-700 focus:outline-none
                      focus:ring-2 focus:ring-purple-500 focus:ring-offset-2 disabled:bg-purple-400
                      focus:ring-offset-purple-200 ">
                                       <i class="fa fa-picture-o"></i> انتخاب عکس
                                     </a>
                                   </span>

                            <input id="profile_image"
                                   value="{{old("profile_image",$user->profile_image)}}"
                                   class="  rounded-l-lg
                                border-transparent
                                                   w-full md:w-1/2 py-2 px-4 bg-white
                                                    text-gray-700 placeholder-gray-400
                                                    shadow-sm text-base focus:outline-none
                                                    focus:ring-2 focus:ring-purple-600
                                                    focus:border-transparent" type="text"
                                   name="profile_image">

                            <x-error-input-dashboard name="profile_image" ></x-error-input-dashboard>

                        </div>

                        <div class="my-3 flex gap-3">
                            <x-button-primary-dashboard textButton="ویرایش"></x-button-primary-dashboard>
                            <x-button-cancel-dashboard :route="route('teacher.dashboard')"></x-button-cancel-dashboard>
                        </div>
                    </form>
                </div>
            </div>
            <div class="p-6 mt-8">
                <div class="w-full rounded-lg block">
                    <form action="{{route("teacher.password.update")}}" method="post" class=" w-full ">
                        @csrf
                        @method("PUT")
                        <div class="relative">
                            <x-label-input-dashboard for="current_password" label="رمز عبور:"></x-label-input-dashboard>
                            <x-input-dashboard type="password"  name="current_password" placeholder="رمز عبور را وارد کنید">
                            </x-input-dashboard>
                            <x-error-input-dashboard name="current_password">
                            </x-error-input-dashboard>
                        </div>
                        <div class="relative">
                            <x-label-input-dashboard for="password" label="رمزعبور جدید:"></x-label-input-dashboard>
                            <x-input-dashboard type="password"   name="password"
                                               placeholder="رمزعبور جدید را وارد کنید"></x-input-dashboard>
                            <x-error-input-dashboard name="password"></x-error-input-dashboard>
                        </div>
                        <div class="relative">
                            <x-label-input-dashboard for="password_confirmation" label="تکرار رمز عبور:"></x-label-input-dashboard>
                            <x-input-dashboard type="password"  name="password_confirmation"
                                               placeholder="تکرار رمز عبور را وارد کنید"></x-input-dashboard>
                            <x-error-input-dashboard name="password_confirmation"></x-error-input-dashboard>
                        </div>
                        <div class="my-3 flex gap-3">
                            <x-button-primary-dashboard textButton="ویرایش رمز عبور"></x-button-primary-dashboard>
                            <x-button-cancel-dashboard :route="route('teacher.dashboard')"></x-button-cancel-dashboard>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @section("script")
        <script>
            document.addEventListener("DOMContentLoaded", function () {

                document.getElementById('lfm').addEventListener('click', (event) => {
                    event.preventDefault();

                    window.open('/file-manager/fm-button', 'fm', 'width=1400,height=800');
                });
            });

            // set file link
            function fmSetLink(url) {
                document.getElementById("profile_image").value = url
            }
        </script>
    @endsection
</x-teacher-layout>
