<?php

namespace App\Rules;

use App\Models\Lessen;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class LessonTimeAvailabilityRule implements ValidationRule
{
    public function __construct(protected $lessen = null)
    {
    }

    /**
     * Run the validation rule.
     *
     * @param string $attribute
     * @param mixed $value
     * @param Closure $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $rule = Lessen::isTimeAvailable(request()->input('weekday'), $value, request()->input('end_time'),
            request()->input('class_id'), request()->input('teacher_id'), $this->lessen);
        if (!$rule) {
            $fail('زمان انتخاب شده قبلا برای کلاس دیگری ثبت شده است.');
        }
    }

}
