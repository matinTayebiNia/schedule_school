<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'name' => ['string', 'max:255'],
            'family' => ["required", "string"],
            "phone" => ["required", Rule::unique("users")->ignore($this->user()->phone,"phone"), "digits:11", "numeric"],
            "profile_image" => ["nullable"],
        ];
    }
}
