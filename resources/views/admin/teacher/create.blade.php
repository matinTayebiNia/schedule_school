<div>

    <div class="-mx-4 sm:-mx-8 px-4 sm:px-8 py-4 overflow-x-auto">
        <div class="inline-bloc bg-white min-w-full shadow rounded-lg overflow-hidden">
            <div class="flex flex-row mb-1 p-4 sm:mb-0 justify-between w-full">
                <h2 class="text-2xl leading-tight">
                    {{$title}}
                </h2>
            </div>
            <div class="p-6 mt-8">
                <div class="w-full rounded-lg block">
                    <form wire:submit.prevent="save" class=" w-full ">
                        <div class="relative">
                            <x-label-input-dashboard for="name" label="نام:"/>
                            <x-input-dashboard livewireModel="name" name="name" placeholder="نام را وارد کنید"/>
                            <x-error-input-dashboard name="name"/>
                        </div>
                        <div class="relative">
                            <x-label-input-dashboard for="family" label="نام خانوادگی:"/>
                            <x-input-dashboard livewireModel="family" name="family"
                                               placeholder="نام خانوادگی را وارد کنید"/>
                            <x-error-input-dashboard name="family"/>
                        </div>
                        <div class="relative">
                            <x-label-input-dashboard for="password" label="رمزعبور:"/>
                            <x-input-dashboard type="password" livewireModel="password" name="password"
                                               placeholder="رمزعبور را وارد کنید"/>
                            <x-error-input-dashboard name="password"/>
                        </div>
                        <div class="relative">
                            <x-label-input-dashboard for="phone" label="شماره تلفن:"/>
                            <x-input-dashboard livewireModel="phone" name="phone"
                                               placeholder="شماره تلفن را وارد کنید"/>
                            <x-error-input-dashboard name="phone"/>
                        </div>
                        <div class="relative">
                            <x-label-input-dashboard for="personal_code" label="کد ملی:"/>
                            <x-input-dashboard livewireModel="personal_code" name="personal_code"
                                               placeholder="کد ملی را وارد کنید"/>
                            <x-error-input-dashboard name="personal_code"/>
                        </div>
                        <div class="relative">
                            <x-label-input-dashboard for="address" label="ادرس:"/>
                            <textarea id="address"
                                      class="    rounded-lg  flex-1
                                                   appearance-none border
                                                   w-full md:w-1/2 py-2 px-4 bg-white
                                                    text-gray-700 placeholder-gray-400
                                                    shadow-sm text-base focus:outline-none
                                                    focus:ring-2 focus:ring-purple-600
                                                    focus:border-transparent
"

                                      wire:model="address" placeholder="ادرس">{{old("address")}}</textarea>
                            <x-error-input-dashboard name="address"/>
                        </div>
                        <div class="relative">
                            <x-label-input-dashboard for="profile_image" label="پروفایل:"/>
                            <x-input-dashboard livewireModel="profile_image" name="profile_image"
                                               placeholder="پروفابل"/>
                            <x-error-input-dashboard name="profile_image"/>
                        </div>
                        <div class="my-3 flex gap-3">
                            <x-button-primary-dashboard targetLoading="save" icon=' <svg aria-hidden="true" wire:loading wire:target="save" role="status"
         class="inline w-4 h-4 mr-3 text-white animate-spin" viewBox="0 0 100 101"
         fill="none" xmlns="http://www.w3.org/2000/svg">
        <path
            d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
            fill="#E5E7EB"/>
        <path
            d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
            fill="currentColor"/>
    </svg>'/>
                            <x-button-cancel-dashboard :route="route('admin.teacher.index')"/>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>
