<?php

namespace App\Livewire\Admin\Student;

use App\Models\Student;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\On;
use Livewire\Component;

class CreateStudent extends Component
{
    public string $name="";

    public string $family="";

    public string $password="";

    public string $personal_code="";

    public string $address="";

    public string $profile_image="";

    #[On("set_profile_image")]
    public function setProfileImage($image)
    {
        $this->profile_image=$image;
    }


    /**
     * @return string[]
     */
    public function messages(): array
    {
        return [
            "name.required" => 'نام وارد نشده',
            "name.min" => "نام باید بیشتر از 3 کاراتر باشد",
            "name.max" => 'مقدار نام بیشتر از حد مجاز است',
            "family.required" => 'نام خانوادگی وارد نشده',
            "family.min" => "نام خانوادگی باید بیشتر از 3 کاراتر باشد",
            "family.max" => 'مقدار نام خانوادگی بیشتر از حد مجاز است',
            "password.required" => 'رمز عبور وارد نشده',
            "password.min" => "رمز عبور باید بیشنر از 8 کاراتر باشد",
            "personal_code.required" => "کد ملی وارد نشده",
            "personal_code.numeric" => 'کد ملی باید عدد باشد',
            "personal_code.digits" => 'کد ملی باید 10 عدد باشد',
            "personal_code.unique" => 'کد ملی تکراری میباشد',
            "address.required" => 'ادرس وارد نشده',
        ];
    }

    public function rules(): array
    {
        return [
            "name" => ["required", "min:3", "max:200"],
            "family" => ["required", "min:3", "max:200"],
            "password" => ["required", "min:8"],
            "personal_code" => ["required", "unique:students", "numeric", "digits:10"],
            "address" => ["required"],
            "profile_image" => ["nullable"]
        ];
    }

    public function render(): View
    {
        $title = "ثبت دانش آموز";
        return view('admin.student.create', compact("title"))
            ->layout("admin.layouts.admin-layout");
    }

    /**
     * @throws AuthorizationException
     */
    public function mount()
    {
        $this->authorize("create-student");
    }

    /**
     * @throws AuthorizationException
     */
    public function save()
    {
        $this->authorize("create-student");

        $this->validate();

        Student::create($this->all());

        session()->flash("success", "دانش آموز مورد نظر با موفقیت ثبت شد.");

        $this->redirect(route('admin.student.index'));
    }
}
