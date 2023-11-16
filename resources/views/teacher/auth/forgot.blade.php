<x-guest-layout>
    <div class="mb-4 text-sm text-gray-600">
        {{ __('رمز عبور حود را فراموش کرده اید ؟ با وارد کردن شماره تلفن کد بازیابی رمز عبور را دریافت کنید.') }}
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('teacher.password.phone') }}">
    @csrf

    <!-- phone -->
        <div>
            <x-input-label for="phone" :value="__('phone')" ></x-input-label>
            <x-text-input id="phone" class="block mt-1 w-full" type="text" name="phone" :value="old('phone')"
                          required autofocus > </x-text-input>
            <x-input-error :messages="$errors->get('phone')" class="mt-2" ></x-input-error>
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button>
                {{ __('ارسال کد') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
