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
                    <form action="{{route("admin.users.permission",$user->id)}}" method="post">
                        @csrf
                        <div class="relative">
                            <x-label-input-dashboard for="permissions" label="انتخاب دسترسی:">
                            </x-label-input-dashboard>
                            <select class="js-example-basic-single foo w-1/2" id="permissions" multiple
                                    name="permissions[]">
                                @foreach(\App\Models\Permission::all() as $permission)
                                    <option
                                        value="{{$permission->id}}"
                                        {{in_array($permission->id,
old("permissions",$user->permissions->pluck("id")->toArray()))?"selected":""}}>
                                        {{$permission->name}}</option>
                                @endforeach
                            </select>
                            <x-error-input-dashboard name="permissions">
                            </x-error-input-dashboard>
                        </div>
                        <div class="relative">
                            <x-label-input-dashboard for="roles" label="انتخاب مقام:">
                            </x-label-input-dashboard>
                            <select class="js-example-basic-single foo w-1/2" id="roles" multiple
                                    name="roles[]">
                                @foreach(\App\Models\Role::all() as $role)
                                    <option
                                        value="{{$role->id}}"
                                        {{in_array($role->id,
old("roles",$user->roles->pluck("id")->toArray()))?"selected":""}}>
                                        {{$role->name}}</option>
                                @endforeach
                            </select>
                            <x-error-input-dashboard name="roles">
                            </x-error-input-dashboard>
                        </div>
                        <div class="my-3 flex gap-3">
                            <x-button-primary-dashboard textButton="ثبت">

                            </x-button-primary-dashboard>

                            <x-button-cancel-dashboard :route="route('admin.users.index')">

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
