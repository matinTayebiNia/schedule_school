<?php

namespace App\Livewire\Admin\UserAdmin;

use App\Models\User;
use Illuminate\Auth\Access\AuthorizationException;
use Livewire\Attributes\On;
use Livewire\Component;

class CreateAdminUser extends Component
{
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
        $this->profile_image = $image;
    }

    public function render()
    {

        $title = "ثبت کاربر ادمین جدید";

        return view('admin.user_admin.create', compact("title"))
            ->layout("admin.layouts.admin-layout");

    }


    public function rules(): array
    {
        return [
            "name" => ["required", "min:3", "max:200"],
            "family" => ["required", "min:3", "max:200"],
            "password" => ["required", "min:8"],
            "phone" => ["required", "unique:users", "numeric", "digits:11"],
            "personal_code" => ["required", "unique:users", "numeric", "digits:10"],
            "address" => ["required"],
            "profile_image" => ["nullable"]
        ];
    }

    /**
     * @throws AuthorizationException
     */
    public function mount()
    {
        $this->authorize("create-user");
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
            "phone.digits" => 'تلفن همراه باید 11 عدد باشد',
            "phone.unique" => 'تلفن همراه تکراری میباشد',
            "personal_code.required" => "کد ملی وارد نشده",
            "personal_code.numeric" => 'کد ملی باید عدد باشد',
            "personal_code.digits" => 'کد ملی باید 10 عدد باشد',
            "personal_code.unique" => 'کد ملی تکراری میباشد',
            "address.required" => 'ادرس وارد نشده',
        ];
    }

    /**
     * @throws AuthorizationException
     */
    public function save()
    {

        $this->authorize("create-user");

        $data = $this->validate();

        $data["password"] = generatePasswordForNewUser($data["personal_code"], $data["password"]);

        User::create([...$data, "is_staff" => true]);

        session()->flash("success", "کاربر ادمین با موفقیت ثبت شد");

        $this->redirect(route("admin.users.index"));

    }
}
