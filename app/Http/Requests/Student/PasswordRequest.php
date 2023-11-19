<?php

namespace App\Http\Requests\student;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class PasswordRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'current_password' => ['required', 'current_password'],
            'password' => ['required', Password::defaults(), 'confirmed'],
        ];
    }

    /**
     * @return array<string>
     */
    public function messages(): array
    {
        return [
            "current_password.required" => "رمز قبلی وارد نشده",
            "current_password.current_password" => "رمز قبلی اشتباه است",
            "password.required" => "رمز جدید وارد نشده",
            "password.confirmed" => "رمز جدید و تکرار آن باهم یکی نیست",
            "password.min" => "رمز جدید باید بیشتر از 8 کاراکتر باشد."
        ];
    }
}
