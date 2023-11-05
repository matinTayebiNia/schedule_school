<x-admin-layout>
    @can("see-classes")
        <div
            class="flex flex-wrap w-full  flex-col px-4 py-8 bg-white rounded-lg shadow  sm:px-6 md:px-8 lg:px-10 my-3">
            <div class=" mb-1 sm:mb-0 justify-between w-full">

                @can("create-class")
                    <h2 class="text-xl leading-tight">
                       اضافه کردن کلاس
                    </h2>
                    <form action="{{route("admin.class.create",["school"=>request()->route()->school->id])}}" method="post">
                        @csrf
                        <div class="w-full " x-data="handler()">
                            <div class="col">
                                <template x-for="(field, index) in fields" :key="index">
                                    <div class="relative mt-3">
                                        <label :for="'classes['+index+'][name]'" class="mb-2 block font-semibold">نام کلاس
                                            :</label>
                                        <div class="flex w-1/2">
                                            <input :id="'classes['+index+'][name]'" x-model="field.name_class"
                                                   type="text" :name="'classes['+index+'][name]'"
                                                   class=" rounded-r-lg  flex-1
                                                   appearance-none border
                                                   w-full md:w-1/2 py-2 px-4 bg-white
                                                    text-gray-700 placeholder-gray-400
                                                    shadow-sm text-base focus:outline-none
                                                    focus:ring-2 focus:ring-purple-600
                                                    focus:border-transparent" required="فیلد نام الزامی است ">

                                            <button type="button" class="p-2 rounded-l-lg
                                   bg-purple-600 hover:bg-purple-700 text-white "
                                                    @click="removeField(index)">حذف فیلد
                                            </button>
                                        </div>
                                    </div>
                                </template>
                            </div>

                            <button type="button" class="px-3 py-2 my-3 rounded bg-blue-600 hover:bg-blue-800 text-white " @click="addNewField()">
                                افزودن
                            </button>
                        </div>
                        <div class="border-t-2 p-2">
                            <x-button-primary-dashboard textButton="ثبت کلاس ها">
                            </x-button-primary-dashboard>
                        </div>
                    </form>

                @endcan


                <hr class="w-full my-3">

                <h2 class="text-xl leading-tight">
                    {{$title}}
                </h2>
                <div class="w-full p-4 grid md:grid-cols-4 sm:grid-col-1 gap-4 grid-cols-2">

                    @foreach($classes as $class)
                        <div
                            class="block rounded-lg  bg-white
                             shadow-[0_2px_15px_-3px_rgba(0,0,0,0.07),0_10px_20px_-2px_rgba(0,0,0,0.04)] ">
                            <div
                                class="relative overflow-hidden bg-cover bg-no-repeat"
                            >
                                <img
                                    class="rounded-t-lg"
                                    src="{{asset("/images/class.jpg")}}"
                                    alt=""/>
                                <a href="#!">
                                    <div
                                        class="absolute bottom-0 left-0 right-0 top-0 h-full w-full
                                 overflow-hidden bg-[hsla(0,0%,98%,0.15)] bg-fixed opacity-0 transition duration-300 ease-in-out hover:opacity-100"></div>
                                </a>
                            </div>
                            <div class="p-6">
                                <h5
                                    class="mb-2 text-xl font-medium leading-tight text-neutral-800 ">
                                    {{$class->name}}
                                </h5>
                                <div class="flex gap-3">
                                    @can("edit-class")
                                        <a
                                            href="{{route("admin.class.edit",["school"=>request()->route()->school->id,"class"=>$class->id])}}"
                                            class="inline-block rounded bg-blue-600 px-6 pb-2 pt-2.5 text-xs font-medium uppercase
                            leading-normal text-white shadow-[0_4px_9px_-4px_#3b71ca] transition duration-150 ease-in-out
                             hover:bg-primary-600 hover:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)]
                             focus:bg-primary-600 focus:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)]
                             focus:outline-none focus:ring-0 active:bg-primary-700 active:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)]
                           "
                                        >
                                            ویرایش
                                        </a>
                                    @endcan
                                    @can("delete-class")
                                        <button
                                            x-on:click="[showModal=true, target_id='{{$class->id}}']"
                                            class="inline-block rounded bg-red-500 px-6 pb-2 pt-2.5 text-xs font-medium uppercase leading-normal text-white shadow-[0_4px_9px_-4px_#dc4c64]
                                     transition duration-150 ease-in-out hover:bg-danger-600 hover:shadow-[0_8px_9px_-4px_rgba(220,76,100,0.3),0_4px_18px_0_rgba(220,76,100,0.2)]
                                    focus:bg-danger-600 focus:shadow-[0_8px_9px_-4px_rgba(220,76,100,0.3),0_4px_18px_0_rgba(220,76,100,0.2)]
                                    focus:outline-none focus:ring-0 active:bg-danger-700 active:shadow-[0_8px_9px_-4px_rgba(220,76,100,0.3),0_4px_18px_0_rgba(220,76,100,0.2)] ">
                                            حذف
                                        </button>
                                    @endcan
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                @can("delete-class")
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
                                <p class="text-2xl font-bold">حذف کلاس!</p>
                                <div class="cursor-pointer z-50" @click="showModal = false">
                                    <svg class="fill-current text-black" xmlns="http://www.w3.org/2000/svg"
                                         width="18"
                                         height="18" viewBox="0 0 18 18">
                                        <path
                                            d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z"></path>
                                    </svg>
                                </div>
                            </div>
                            <form action="{{route("admin.class.destroy",["school"=>request()->route()->school->id])}}"
                                  method="post" class="my-2">
                                @method("DELETE")
                                @csrf
                                <input type="hidden" name="class_id" :value="$data.target_id">

                                <!-- content -->

                                <p>ایا از حذف کلاس مورد نظر مطمئن هستید</p>

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
            </div>
        </div>
    @endcan
    @section("script")
        <script>
            function handler() {
                return {
                    fields: [],
                    addNewField() {
                        this.fields.push({
                            name_class: '',
                        });
                    },
                    removeField(index) {
                        this.fields.splice(index, 1);
                    }
                }
            }
        </script>
    @endsection
</x-admin-layout>
