<x-student-layout>

    <div class="-mx-4 sm:-mx-8 px-4 sm:px-8 py-4 overflow-x-auto">
        <div class="inline-bloc bg-white min-w-full shadow rounded-lg overflow-hidden">
            <div class="flex flex-row mb-1 p-4 sm:mb-0 justify-between w-full">
                <h2 class="text-2xl leading-tight">
                    {{$title}}
                </h2>

            </div>
            <div class="px-6">
                @if($errors->any())
                    <div class="flex p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 "
                         role="alert">
                        <svg class="flex-shrink-0 inline w-4 h-4 me-3 mt-[2px]" aria-hidden="true"
                             xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                            <path
                                d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
                        </svg>
                        <div>
                            <span class="font-medium">لطفا خطا های زیر توجه کنید:</span>
                            <ul class="mt-1.5 list-disc list-inside">
                                @foreach($errors->all() as $error)
                                    <li>{{is_array($error)?$error[0]:$error}}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                @endif
                <div class="w-full rounded-lg block">
                    <form action="{{route("student.units.store")}}" method="post" class=" w-full ">
                        @csrf
                        <div class="relative">
                            @foreach($units as $unit)
                                <div class="flex items-center mb-4">
                                    <input id="default-checkbox" type="checkbox" value="{{$unit->id}}" name="units[]"
                                           class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500">
                                    <label for="default-checkbox"
                                           class="ms-2 text-sm font-medium text-gray-900">   {{$unit->lessen->name}} ---
                                        استاد:{{$unit->teacher->name." ".$unit->teacher->family}} ---
                                        ظرفیت: {{$unit->student_limit - $unit->students->count()}}</label>
                                </div>
                            @endforeach
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
</x-student-layout>


