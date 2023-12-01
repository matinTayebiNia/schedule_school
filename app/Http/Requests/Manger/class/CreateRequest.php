<?php

namespace App\Http\Requests\Manger\class;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class CreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Gate::allows("create_class", $this->school->id);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            "classes" => ["required", "array"],
            "classes.*.name" => ["required", "string"]
        ];
    }

    public function messages(): array
    {
        return [
            "classes.required" => "کلاسی نوشته نشده",
            "classes.array" => "مقدار کلاس ها باید لیستی از دیتا باشند",
            "classes.*.name.required" => "نام کلاس وارد نشده",
        ];
    }
}
