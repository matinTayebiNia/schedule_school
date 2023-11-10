<?php

namespace App\Http\Requests\Admin\Unite;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;

class StoreUniteRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Gate::allows("create-unite");
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {

        return [
            "class_id" => ["required", "numeric", Rule::unique("units", "class_id")
                ->where("teacher_id", $this->input("teacher_id"))->where("lessen_id", $this->input("lessen_id"))],
            'teacher_id' => ["required", "numeric", Rule::unique("units", "teacher_id")
                ->where("class_id", $this->input("class_id"))->where("lessen_id", $this->input("lessen_id"))],
            "lessen_id" => ["required", "numeric", Rule::unique("units", "lessen_id")
                ->where("class_id", $this->input("class_id"))->where("teacher_id", $this->input("teacher_id"))],
            "weekday" => ["required", "string", Rule::unique("units", "weekday")
                ->where("start_time", $this->input("start_time"))
                ->where("end_time", $this->input("end_time"))->where("teacher_id", $this->input("teacher_id"))],
            "student_limit" => ["required", "numeric"],
            "start_time" => ["required", "date_format:H:i"],
            "end_time" => ["required", "date_format:H:i", "after:start_time"],
        ];
    }

    public function messages(): array
    {
        return [
            "class_id.required" => "کلاس انتخاب نشده",
            "class_id.unique" => "این کلاس برای این درس قبلا انتخاب شده",
            "teacher_id.required" => "معلم انتخاب نشده",
            "teacher_id.unique" => "معلم انتخاب شده برای این درس قبلا انتخاب شده است",
            "lessen_id.required" => "درس انتخاب نشده",
            "lessen_id.unique" => "درس انتخاب شده برای این معلم و کلاس قبلا انتخاب شده است",
            "weekday.required" => "روز واحد انتخاب نشده",
            "weekday.unique" => "معلم مورد نظر در زمان انتخاب شده درس دیگری دارد.",
            "student_limit.required" => "ظرفیت واحد وارد نشده",
            "student_limit.numeric" => "ظرفیت واحد باید عدد باشد",
            "start_time.required" => "زمان شروع وارد نشده",
            "start_time.date_format" => "زمان وارد شده فرمت درستی ندارد",
            "end_time.required" => "زمان پایان وارد نشده",
            "end_time.date_format" => "زمان وارد شده فرمت درستی ندارد",
            "end_time.after" => "زمان پابان باید بعد از زمان شروع باشد",
        ];
    }
}
