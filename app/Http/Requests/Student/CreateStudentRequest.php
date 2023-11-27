<?php

namespace App\Http\Requests\Student;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateStudentRequest extends FormRequest
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
     * @return string[]
     */
    public function rules(): array
    {
        return [
            "units" => ['required', "array"],
            "units.*" => ["numeric"],
        ];
    }

    /**
     * Get the validation messages that apply to the request.
     *
     * @return string[]
     */
    public function messages(): array
    {
        return [
            "units.required" => "واحدی انتخاب نشده",
            "units.*.numeric" => "واحد باید لیستی از عداد باشد",
        ];
    }
}
