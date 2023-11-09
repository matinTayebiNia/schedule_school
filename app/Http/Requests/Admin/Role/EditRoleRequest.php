<?php

namespace App\Http\Requests\Admin\Role;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;

class EditRoleRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Gate::allows("edit-role");
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            "name" => ["required", Rule::unique("roles")->ignore($this->role->name
                , "name"), "string", "min:3"],
            "label" => ["required", "string", "min:3"],
            "permissions" => ["required", "array"],
            "permissions.*" => ["numeric"]
        ];
    }

    /**
     * @return string[]
     */
    public function messages(): array
    {
        return [
            "name.required" => 'نام وارد نشده',
            "name.min" => "نام باید بیشتر از 3 کاراتر باشد",
            "name.unique" => "نام تکراری میباشد",
            "label.required" => 'توضیحات وارد نشده',
            "label.min" => "توضیحات باید بیشتر از 3 کاراتر باشد",
            "permissions.required" => "دسترسی انتخاب نشده"
        ];
    }
}
