<x-guest-layout>
    <x-auth-session-status class="mb-4" :status="session('success')">
    </x-auth-session-status>
    <form method="POST" action="{{ route('teacher.reset.store') }}">
    @csrf


        <div>
            <x-input-label for="code" :value="__('کد تایید')"/>
            <x-text-input id="code" class="block mt-1 w-full" type="number" name="code"
                          autofocus autocomplete="username"/>
            <x-input-error :messages="$errors->get('code')" class="mt-2"/>
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('رمز عبور')"/>
            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password"
                          autocomplete="new-password"/>
            <x-input-error :messages="$errors->get('password')" class="mt-2"/>
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('تکرار رمز عبور')"/>

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                          type="password"
                          name="password_confirmation" autocomplete="new-password"/>

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2"/>
        </div>

        <div class="flex items-center gap-3 space-x-3 justify-end mt-4">

            <a href="#" onclick="event.preventDefault();document.getElementById('resend-code').submit();" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md
                    focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                {{ __('ارسال دوباره کد') }}
            </a>
            <x-primary-button>
                {{ __('بازیابی رمز عبور') }}
            </x-primary-button>

        </div>
    </form>
    <form action="{{route("teacher.resend.code")}}" id='resend-code' method="post">
        @csrf
    </form>
</x-guest-layout>
