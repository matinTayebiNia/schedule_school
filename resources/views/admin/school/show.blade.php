<x-admin-layout>
    @can("see-school")
        <div
            class="flex
            flex-wrap w-full
             flex-col px-4 py-8
              bg-white rounded-lg shadow
             sm:px-6 md:px-8 lg:px-10 my-3">

            <div class="flex flex-row mb-1 pb-4 border-b-2 sm:mb-0 justify-between w-full">
                <h2 class="text-2xl leading-tight">
                    مدرسه {{$school->name}}
                </h2>
                <h2 class="text-2xl  leading-tight">
                    تعداد کلاس: {{$school->classes->count()}}
                </h2>
            </div>
           <div class="my-3">
               <h4 class="mb-2">آدرس:</h4>
               <p class="text-gray-600 text-right font-light">
                   {{$school->address}}
               </p>
           </div>
        </div>
    @endcan
</x-admin-layout>
