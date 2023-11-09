<?php

namespace App\Http\Requests\Admin\Unite;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;

class EditUniteRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Gate::allows("edit-unite");
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            "class_id" => ["required", "numeric", Rule::unique("units", "class_id")->ignore("class_id", $this->unit->class_id)
                ->where("teacher_id", $this->input("teacher_id"))->where("lessen_id", $this->input("lessen_id"))],
            'teacher_id' => ["required", "numeric", Rule::unique("units", "teacher_id")->ignore("teacher_id", $this->unit->teacher_id)
                ->where("class_id", $this->input("class_id"))->where("lessen_id", $this->input("lessen_id"))],
            "lessen_id" => ["required", "numeric", Rule::unique("units", "lessen_id")->ignore("lessen_id", $this->unit->lessen_id)
                ->where("class_id", $this->input("class_id"))->where("teacher_id", $this->input("teacher_id"))],
            "weekday" => ["required", "string"],
            "student_limit" => ["required", "numeric"],
            "start_time" => ["required", "date_format:H:i"],
            "end_time" => ["required", "date_format:H:i"],
        ];
    }
}
