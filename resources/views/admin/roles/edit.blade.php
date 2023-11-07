<x-admin-layout>

    <div
        class="flex flex-wrap w-full  flex-col px-4 py-8 bg-white rounded-lg shadow  sm:px-6 md:px-8 lg:px-10 my-3">
        <div class="inline-bloc bg-white min-w-full shadow rounded-lg overflow-hidden">
            <div class="flex flex-row mb-1 p-4 sm:mb-0 justify-between w-full">
                <h2 class="text-2xl leading-tight">
                    {{$title}}
                </h2>
            </div>

            <div class="p-6 mt-8">
                <div class="w-full rounded-lg block">
                    <form action="{{route("admin.roles.update",$role->id)}}" method="post">
                        @method("PUT")
                        @csrf
                        <div class="relative">
                            <x-label-input-dashboard for="name" label="نام مقام:">
                            </x-label-input-dashboard>
                            <x-input-dashboard livewireModel="name" :value="$role->name" name="name"
                                               placeholder="نام مقام را وارد کنید">
                            </x-input-dashboard>
                            <x-error-input-dashboard name="name">
                            </x-error-input-dashboard>
                        </div>
                        <div class="relative">
                            <x-label-input-dashboard for="label" label="توضیحات:">
                            </x-label-input-dashboard>
                            <x-input-dashboard livewireModel="label" :value="$role->label" name="label"
                                               placeholder="توضیحات را وارد کنید">
                            </x-input-dashboard>
                            <x-error-input-dashboard name="label">
                            </x-error-input-dashboard>
                        </div>
                        <div class="relative">
                            <x-label-input-dashboard for="permissions" label="انتخاب دسترسی:">
                            </x-label-input-dashboard>
                            <select class="js-example-basic-single foo w-1/2" id="permissions" multiple
                                    name="permissions[]">
                                @foreach($permissions as $permission)
                                    <option
                                        value="{{$permission->id}}"
                                        {{in_array($permission->id,old("permissions",
    $role->permissions->pluck("id")->toArray()))?"selected":""}}>
                                        {{$permission->name}}</option>
                                @endforeach
                            </select>
                            <x-error-input-dashboard name="permissions">
                            </x-error-input-dashboard>
                        </div>
                        <div class="my-3 flex gap-3">
                            <x-button-primary-dashboard textButton="ویرایش">

                            </x-button-primary-dashboard>

                            <x-button-cancel-dashboard :route="route('admin.roles.index')">

                            </x-button-cancel-dashboard>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @section("script")
        <script>
            $(document).ready(() => {
                $('.js-example-basic-single').select2();
            })
        </script>
    @endsection
</x-admin-layout>
