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
                    <form action="{{route("admin.units.create")}}" method="post" class=" w-full ">
                        @csrf
                        <div class="relative">
                            <x-label-input-dashboard for="class_id" label="انتخاب مدرسه">
                            </x-label-input-dashboard>
                            <select class="js-example-basic-single foo w-1/2" id="school"
                                    name="school">
                                @foreach(\App\Models\School::all() as $school)
                                    <option
                                        value="{{$school->id}}"
                                        {{$school->id==old("school")?"selected":""}}>
                                        {{$school->name}}</option>
                                @endforeach
                            </select>
                            <x-error-input-dashboard name="class_id">
                            </x-error-input-dashboard>
                        </div>
                        <div class="relative">
                            <x-label-input-dashboard for="class_id" label="انتخاب کلاس">
                            </x-label-input-dashboard>
                            <select class="js-example-basic-single foo w-1/2" id="class_id"
                                    name="class_id">
                                <option value="">قبل از انتخاب کلاس ، مدرسه ای انتخاب کنید</option>
                            </select>
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
                            <x-input-dashboard  name="student_limit" id="student_limit"
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

</x-admin-layout>

@section("script")
    <script>
        $(document).ready(() => {
            $('.js-example-basic-single').select2();
        })
    </script>
@endsection
