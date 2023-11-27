<?php

namespace App\Http\Requests\Manger\Lessen;

use App\Rules\LessonTimeAvailabilityRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class CreateLessonRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Gate::allows("create-lessen");
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            "name" => ["required", "min:3", "max:225"],
            'class_id' => [
                'required',
                'integer'],
            'teacher_id' => [
                'required',
                'integer'],
            'weekday' => [
                'required',
                'integer',
                'min:1',
                'max:7'],
            'start_time' => [
                'required',
                new LessonTimeAvailabilityRule(),
                'date_format:' . config('panel.lesson_time_format')],
            'end_time' => [
                'required',
                'after:start_time',
                'date_format:' . config('panel.lesson_time_format')],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => "نام الزامی میباشد",
            "name.min" => "مقدار وارد شده باید بیشتر از 3 کاراتر باشد",
            "name.max" => "مقدار وارد شده بیش از حد مجاز "
        ];

    }
}
