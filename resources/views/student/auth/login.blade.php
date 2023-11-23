<x-guest-layout title="ورود دانش آموز">
    <x-auth-session-status class="mb-4" :status="session('success')">
    </x-auth-session-status>
    <form action="{{route("student.login")}}" method="POST">
    @csrf
    <!-- Email Address -->
        <div>
            <x-input-label for="personal_code" value="کد ملی"/>
            <x-text-input id="personal_code" class="block mt-1 w-full" type="text" name="personal_code"
                          :value="old('personal_code')" required autofocus autocomplete="username"/>
            <x-input-error :messages="$errors->get('personal_code')" class="mt-2"/>
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" value="رمز عبور"/>

            <x-text-input id="password" class="block mt-1 w-full"
                          type="password"
                          name="password"
                          required autocomplete="current-password"/>

            <x-input-error :messages="$errors->get('password')" class="mt-2"/>
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox"
                       class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                <span class="ml-2 text-sm text-gray-600">مرا به خاطر بسپار</span>
            </label>
        </div>

        <div class="flex items-center justify-end mt-4">


            <x-primary-button class="ml-3">
                ورود
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
