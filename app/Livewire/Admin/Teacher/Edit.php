<?php

namespace App\Livewire\Admin\Teacher;

use App\Models\Teacher;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;
use JetBrains\PhpStorm\ArrayShape;
use Livewire\Attributes\On;
use Livewire\Component;

class Edit extends Component
{
//todo add city and state to edit teacher
    public int $teacher_id;

    public string $name = "";

    public string $family = "";

    public string $password = "";

    public string $phone = "";

    public string $personal_code = "";

    public string $address = "";

    public string $profile_image = "";


    #[On("set_profile_image")]
    public function setProfileImage($image)
    {
        $this->profile_image=$image;
    }

    /**
     * @throws AuthorizationException
     */
    public function mount(Teacher $teacher)
    {
        $this->authorize("update-teacher");

        $this->teacher_id = $teacher->id;

        $this->name = $teacher->name;

        $this->family = $teacher->family;

        $this->phone = $teacher->phone;

        $this->personal_code = $teacher->personal_code;

        $this->address = $teacher->address;

        $this->profile_image = $teacher->profile_image ?? "";

    }

    /**
     * @return View
     */
    public function render(): View
    {
        $title = "ویرایش معلم ";
        return view('admin.teacher.edit', compact("title"))
            ->layout("admin.layouts.admin-layout");
    }

    /**
     * @throws AuthorizationException
     * @throws ValidationException
     */
    public function update(Teacher $teacher)
    {
        $this->authorize("update-teacher");

        $data = $this->validating($teacher);

        $data = unsetPasswordIfIsNull($data);

        $teacher->update($data);

        session()->flash("success", "معلم مورد نظر با موفقیت ویرایش شد");

        $this->redirect(route("admin.teacher.index"));

    }

    /**
     * @param Teacher $teacher
     * @return array
     * @throws ValidationException
     */
    private function validating(Teacher $teacher): array
    {
        return Validator::make(
            [
                "name" => $this->name, "family" => $this->family, "password" => $this->password,
                "phone" => $this->phone, "personal_code" => $this->personal_code, "address" => $this->address,
                "profile_image" => $this->profile_image
            ]
            , [
            "name" => ["required", "min:3", "max:200"],
            "family" => ["required", "min:3", "max:200"],
            "password" => ["nullable", "min:8"],
            "phone" => ["required", Rule::unique("teachers")->ignore($teacher->phone, "phone"), "numeric", "digits:11"],
            "personal_code" => ["required", Rule::unique("teachers")->ignore($teacher->personal_code, "personal_code"), "numeric", "digits:10"],
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
                "phone.required" => "تلفن همراه وارد نشده",
                "phone.numeric" => 'تلفن همراه باید عدد باشد',
                "phone.digits" => 'تلفن همراه باید 11 عدد باشد',
                "phone.unique" => 'تلفن همراه تکراری میباشد',
                "personal_code.required" => "کد ملی وارد نشده",
                "personal_code.numeric" => 'کد ملی باید عدد باشد',
                "personal_code.digits" => 'کد ملی باید 10 عدد باشد',
                "personal_code.unique" => 'کد ملی تکراری میباشد',
                "address.required" => 'ادرس وارد نشده',
            ])->validate();
    }
}
