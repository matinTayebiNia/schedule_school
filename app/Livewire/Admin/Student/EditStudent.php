<?php

namespace App\Livewire\Admin\Student;

use App\Models\Student;
use App\Models\Teacher;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\On;
use Livewire\Component;

class EditStudent extends Component
{

    public int $student_id;

    public string $name = "";

    public string $family = "";

    public string $password = "";

    public string $personal_code = "";

    public string $address = "";

    public string $profile_image = "";

    public function render(): View
    {
        $title = "ویرایش دانش آموز";
        return view('admin.student.edit', compact('title'))
            ->layout("admin.layouts.admin-layout");
    }

    /**
     * @throws AuthorizationException
     */
    public function mount(Student $student)
    {
        $this->authorize("update-student");

        $this->student_id = $student->id;

        $this->name = $student->name;

        $this->family = $student->family;

        $this->address = $student->address;

        $this->personal_code = $student->personal_code;

        $this->profile_image = $student->profile_image ?? "";

    }

    #[On("set_profile_image")]
    public function setProfileImage($image)
    {
        $this->profile_image=$image;
    }

    /**
     * @throws AuthorizationException
     * @throws ValidationException
     */
    public function update(Student $student)
    {
        $this->authorize("update-student");

        $data = $this->validating($student);

        $data = unsetPasswordIfIsNull($data);

        $student->update($data);

        session()->flash("success", "دانش آموز مورد نظر با موفقیت ویرایش شد.");

        $this->redirect(route("admin.student.index"));

    }

    /**
     * @param Student $student
     * @return array
     * @throws ValidationException
     */
    private function validating(Student $student): array
    {
        return Validator::make(
            [
                "name" => $this->name, "family" => $this->family, "password" => $this->password,
                "personal_code" => $this->personal_code, "address" => $this->address,
                "profile_image" => $this->profile_image
            ]
            , [
            "name" => ["required", "min:3", "max:200"],
            "family" => ["required", "min:3", "max:200"],
            "password" => ["nullable", "min:8"],
            "personal_code" => ["required", Rule::unique("teachers")->ignore($student->personal_code,
                "personal_code"), "numeric", "digits:10"],
            "address" => ["required"],
            "profile_image" => ["nullable"]
        ],
            [
                "name.required" => 'نام وارد نشده',
                "name.min" => "نام باید بیشتر از 3 کاراتر باشد",
                "name.max" => 'مقدار نام بیشتر از حد مجاز است',
                "family.required" => 'نام خانوادگی وارد نشده',
                "family.min" => "نام خانوادگی باید بیشتر از 3 کاراتر باشد",
                "family.max" => 'مقدار نام خانوادگی بیشتر از حد مجاز است',
                "password.min" => "رمز عبور باید بیشنر از 8 کاراتر باشد",
                "personal_code.required" => "کد ملی وارد نشده",
                "personal_code.numeric" => 'کد ملی باید عدد باشد',
                "personal_code.digits" => 'کد ملی باید 10 عدد باشد',
                "personal_code.unique" => 'کد ملی تکراری میباشد',
                "address.required" => 'ادرس وارد نشده',
            ])->validate();
    }
}
