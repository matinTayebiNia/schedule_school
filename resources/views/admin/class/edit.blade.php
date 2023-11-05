<x-admin-layout>
    <div class="-mx-4 sm:-mx-8 px-4 sm:px-8 py-4 overflow-x-auto">
        <div class="inline-bloc bg-white min-w-full shadow rounded-lg overflow-hidden">
            <div class="flex flex-row mb-1 p-4 sm:mb-0 justify-between w-full">
                <h2 class="text-2xl leading-tight">
                    {{$title}}
                </h2>
            </div>
            <div class="p-6 mt-8">
                <div class="w-full rounded-lg block">
                    <form action="{{route("admin.class.update",["school"=>$school,"class"=>$class->id])}}"
                          class=" w-full " method="post">
                        @csrf
                        @method("PUT")
                        <div class="relative">
                            <x-label-input-dashboard for="name" label=" نام کلاس:"/>
                            <x-input-dashboard name="name" livewireModel="" :value="$class->name" placeholder="نام را وارد کنید"/>
                            <x-error-input-dashboard name="name"/>
                        </div>

                        <div class="my-3 flex gap-3">
                            <x-button-primary-dashboard targetLoading="update" textButton="ویرایش"
                            ></x-button-primary-dashboard>
                            <x-button-cancel-dashboard :route="route('admin.class.index',$school)"/>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</x-admin-layout>
