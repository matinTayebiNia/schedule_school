<x-admin-layout>

    <div class="-mx-4 sm:-mx-8 px-4 sm:px-8 py-4 overflow-x-auto">
        <div class="inline-bloc bg-white min-w-full shadow rounded-lg overflow-hidden">
            <div class="flex flex-row mb-1 p-4 sm:mb-0 justify-between w-full">
                <h2 class="text-2xl leading-tight">
                    {{$title}}
                </h2>
            </div>
            <div class="px-6">
                <div class="w-full rounded-lg block">
                    <form action="{{route("admin.units.store")}}" method="post" class=" w-full ">
                        @csrf
                        <div class="relative">
                            <x-label-input-dashboard for="class_id" label="انتخاب مدرسه">
                            </x-label-input-dashboard>
                            <select class="js-example-basic-single foo w-1/2" id="school"
                                    name="school">
                                <option value=""> انتخاب کنید</option>
                                @foreach(\App\Models\School::all() as $school)
                                    <option
                                        value="{{$school->id}}">
                                        {{$school->name}}</option>
                                @endforeach
                            </select>
                            <x-error-input-dashboard name="school">
                            </x-error-input-dashboard>
                        </div>
                        <div class="relative">
                            <x-label-input-dashboard for="class_id" label="انتخاب کلاس">
                            </x-label-input-dashboard>
                            <div class="flex items-center ">
                                <select class="js-example-basic-single foo w-1/2" id="class_id"
                                        name="class_id">
                                    <option value="">قبل از انتخاب کلاس ، مدرسه ای انتخاب کنید</option>
                                </select>
                                <svg id="school_loading" aria-hidden="true" role="status"
                                     class="inline  w-6 hidden h-6 mr-3 text-purple-600 animate-spin"
                                     viewBox="0 0 100 101"
                                     fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
                                        fill="#E5E7EB"/>
                                    <path
                                        d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
                                        fill="currentColor"/>
                                </svg>
                            </div>

                            <x-error-input-dashboard name="class_id">
                            </x-error-input-dashboard>
                        </div>
                        <div class="relative">
                            <x-label-input-dashboard for="teacher_id" label="انتخاب معلم">
                            </x-label-input-dashboard>
                            <select class="js-example-basic-single foo w-1/2" id="teacher_id"
                                    name="teacher_id">
                                @foreach(\App\Models\Teacher::all() as $teacher)
                                    <option
                                        value="{{$teacher->id}}"
                                        {{$teacher->id==old("teacher_id")?"selected":""}}>
                                        {{$teacher->family}}::{{$teacher->personal_code}}</option>
                                @endforeach
                            </select>
                            <x-error-input-dashboard name="teacher_id">
                            </x-error-input-dashboard>
                        </div>
                        <div class="relative">
                            <x-label-input-dashboard for="lessen_id" label="انتخاب درس">
                            </x-label-input-dashboard>
                            <select class="js-example-basic-single foo w-1/2" id="lessen_id"
                                    name="lessen_id">
                                @foreach(\App\Models\Lessen::all() as $lessen)
                                    <option
                                        value="{{$lessen->id}}"
                                        {{$lessen->id==old("lessen_id")?"selected":""}}>
                                        {{$lessen->name}}::{{$lessen->code}}</option>
                                @endforeach
                            </select>
                            <x-error-input-dashboard name="lessen_id">
                            </x-error-input-dashboard>
                        </div>
                        <div class="relative">
                            <x-label-input-dashboard for="weekday" label="روز برگذاری">
                            </x-label-input-dashboard>
                            <select class="js-example-basic-single foo w-1/2" id="weekday"
                                    name="weekday">
                                @foreach(config("panel.weekday") as $key=>$weekday)
                                    <option
                                        value="{{$key}}"
                                        {{$key==old("weekday")?"selected":""}}>
                                        {{$weekday}}</option>
                                @endforeach
                            </select>
                            <x-error-input-dashboard name="weekday">
                            </x-error-input-dashboard>
                        </div>
                        <div class="relative">
                            <x-label-input-dashboard for="student_limit" label="ظرفیت دانشجو">
                            </x-label-input-dashboard>
                            <x-input-dashboard name="student_limit" id="student_limit"
                                               placeholder="ظرفبت دانشجو را وارد کنید">
                            </x-input-dashboard>

                            <x-error-input-dashboard name="student_limit">
                            </x-error-input-dashboard>
                        </div>
                        <div class="relative">
                            <x-label-input-dashboard for="start_time" label="زمان شروع">
                            </x-label-input-dashboard>
                            <x-input-dashboard type="time" name="start_time" id="start_time">
                            </x-input-dashboard>
                            <x-error-input-dashboard name="start_time">
                            </x-error-input-dashboard>
                        </div>
                        <div class="relative">
                            <x-label-input-dashboard for="end_time" label="زمان پایان">
                            </x-label-input-dashboard>
                            <x-input-dashboard type="time" name="end_time" id="end_time">
                            </x-input-dashboard>
                            <x-error-input-dashboard name="end_time">
                            </x-error-input-dashboard>
                        </div>

                        <div class="my-3 flex gap-3">
                            <x-button-primary-dashboard textButton="ثبت">
                            </x-button-primary-dashboard>
                            <x-button-cancel-dashboard :route="route('admin.units.index')">
                            </x-button-cancel-dashboard>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @section("script")
        <script>

            document.getElementById("school").addEventListener("change", async (e) => {
                e.preventDefault();
                const icon = document.getElementById("school_loading");
                icon.classList.remove("hidden");
                let url = `/admin/units/${e.target.value}/class`;
                const class_id = $('#class_id');
                fetch(`{{env("APP_URL")}}${url}`, {
                    method: "GET",
                    headers: {
                        "Content-Type": "application/json"
                    }
                }).then(res => res.json())
                    .then(res => {
                        icon.classList.add("hidden")
                        $("#class_id option[value='']").each(function () {
                            $(this).remove();
                        });
                        res.data.forEach(item => {
                            let newOption = new Option(item.name, item.id, true, true)
                            class_id.append(newOption);
                        })
                    })
            })


        </script>
    @endsection
</x-admin-layout>


