<?php

namespace App\Http\Requests\Admin\UserAdmin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class SetPermissionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Gate::allows("allow-to-set-permission");
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            "permissions" => ["nullable", 'array'],
            "permissions.*" => ["nullable", 'numeric'],
            "roles" => ["nullable", 'array'],
            "roles.*" => ["nullable", 'numeric'],
        ];
    }

    /**
     * @return string[]
     */
    public function messages(): array
    {
        return [
            "permissions.*.numeric" => "مقدار وارده شده اجازه دسترسی معتبر نیست ",
            "roles.*.numeric" => "مقدار وارده شده مقام معتبر نیست ",

        ];
    }
}
