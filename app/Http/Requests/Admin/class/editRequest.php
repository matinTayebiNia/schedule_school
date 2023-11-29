<?php

namespace App\Http\Requests\Admin\class;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;
use JetBrains\PhpStorm\ArrayShape;

class editRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Gate::allows("update_class", $this->school);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            "name" => ["required", "min:3", "max:225"]
        ];
    }

    public function messages(): array
    {
        return [
            "name.required" => "نام کلاس الزامی است",
            "name.min" => "نام کلاس باید بیشتر از 3 کاراتر باشد",
            "name.max" => "نام کلاس باید بیش ازحد مجاز",
        ];
    }
}
