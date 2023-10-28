<?php

namespace App\Livewire\Admin\Teacher;

use App\Models\Teacher;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\View\View;
use JetBrains\PhpStorm\ArrayShape;
use Livewire\Component;

class Create extends Component
{

    public string $name = "";

    public string $family = "";

    public string $password = "";

    public string $phone = "";

    public string $personal_code = "";

    public string $address = "";

    public string $profile_image = "";

    /**
     * @return View
     */
    public function render(): View
    {
        return view('admin.teacher.create')
            ->layout("admin.layouts.admin-layout");
    }

    #[ArrayShape(["name" => "string[]", "family" => "string[]",
        "password" => "string[]", "phone" => "string[]",
        "personal_code" => "string[]", "address" => "string[]", "profile_image" => "string[]"])]
    public function rules(): array
    {
        return [
            "name" => ["required", "min:3", "max:200"],
            "family" => ["required", "min:3", "max:200"],
            "password" => ["required", "min:8"],
            "phone" => ["required", "numeric", "size:11"],
            "personal_code" => ["required", "numeric", "size:10"],
            "address" => ["required"],
            "profile_image" => ["nullable"]
        ];
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
            "phone.required" => "تلفن همراه وارد نشده",
            "phone.numeric" => 'تلفن همراه باید عدد باشد',
            "phone.size" => 'تلفن همراه باید 11 عدد باشد',
            "personal_code.required" => "کد ملی وارد نشده",
            "personal_code.numeric" => 'کد ملی باید عدد باشد',
            "personal_code.size" => 'کد ملی باید 10 عدد باشد',
            "address.required" => 'ادرس وارد نشده',
        ];
    }

    /**
     * @throws AuthorizationException
     */
    public function mount()
    {
        $this->authorize("create-teacher");
    }

    /**
     * @throws AuthorizationException
     */
    public function save()
    {
        $this->authorize("create-teacher");

        $data = $this->validate();

        Teacher::create($data);

        session()->flash("success", "معلم با موفقیت ثبت شد");

        $this->redirect(route("admin.teacher.index"));

    }

}
