<?php

namespace App\Livewire\Admin\Teacher;

use App\Models\Teacher;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use JetBrains\PhpStorm\ArrayShape;
use Livewire\Component;

class Edit extends Component
{

    public int $teacher_id;

    public string $name = "";

    public string $family = "";

    public string $password = "";

    public string $phone = "";

    public string $personal_code = "";

    public string $address = "";

    public string $profile_image = "";

    /**
     * @throws AuthorizationException
     */
    public function mount(Teacher $teacher)
    {
        $this->authorize("edit-teacher");

        $this->teacher_id = $teacher->id;

        $this->name = $teacher->name;

        $this->family = $teacher->family;

        $this->phone = $teacher->phone;

        $this->personal_code = $teacher->personal_code;

        $this->address = $teacher->address;

        $this->profile_image = $teacher->profile_image;

    }

    /**
     * @return View
     */
    public function render(): View
    {
        return view('livewire.admin.teacher.edit')
            ->layout("admin.layouts.admin-layout");
    }

    /**
     * @throws AuthorizationException
     * @throws ValidationException
     */
    public function update(Teacher $teacher)
    {
        $this->authorize("edit-teacher");

        $data = $this->validating($teacher);

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
            "password" => ["required", "min:8"],
            "phone" => ["required", "unique:teachers,phone," . $teacher->phone, "numeric", "size:11"],
            "personal_code" => ["required", "unique:teachers,personal_code," . $teacher->personal_code, "numeric", "size:10"],
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
                "password.required" => 'رمز عبور وارد نشده',
                "password.min" => "رمز عبور باید بیشنر از 8 کاراتر باشد",
                "phone.required" => "تلفن همراه وارد نشده",
                "phone.numeric" => 'تلفن همراه باید عدد باشد',
                "phone.size" => 'تلفن همراه باید 11 عدد باشد',
                "phone.unique" => 'تلفن همراه تکراری میباشد',
                "personal_code.required" => "کد ملی وارد نشده",
                "personal_code.numeric" => 'کد ملی باید عدد باشد',
                "personal_code.size" => 'کد ملی باید 10 عدد باشد',
                "personal_code.unique" => 'کد ملی تکراری میباشد',
                "address.required" => 'ادرس وارد نشده',
            ])->validate();
    }
}