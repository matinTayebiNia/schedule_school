<?php

namespace App\Livewire\Admin\UserAdmin;

use App\Models\Teacher;
use App\Models\User;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\On;
use Livewire\Component;

class EditAdminUser extends Component
{
    public int $user_id;

    public string $name = "";

    public string $family = "";

    public string $password = "";

    public string $phone = "";

    public string $personal_code = "";

    public string $address = "";

    public string $profile_image = "";


    /**
     * @return mixed
     */
    public function render(): View
    {

        $title = "ویرایش کاربر ادمین";

        return view('admin.user_admin.edit', compact("title"))
            ->layout("admin.layouts.admin-layout");

    }

    /**
     * @param $image
     * @return void
     */
    #[On("set_profile_image")]
    public function setProfileImage($image)
    {
        $this->profile_image = $image;
    }

    /**
     * @throws AuthorizationException
     */
    public function mount(User $user)
    {
        $this->authorize("edit-user");

        $this->user_id = $user->id;

        $this->name = $user->name;

        $this->family = $user->family;

        $this->phone = $user->phone;

        $this->personal_code = $user->personal_code;

        $this->address = $user->address;

        $this->profile_image = $user->profile_image ?? "";

    }

    /**
     * @throws AuthorizationException
     * @throws ValidationException
     */
    public function update(User $user)
    {

        $this->authorize("edit-user");

        $data = $this->validating($user);

        $user->update($data);

        session()->flash("success", "کاربر ادمین با موفقیت ویرایش شد.");

        $this->redirect(route("admin.users.index"));

    }


    /**
     * @param User $user
     * @return array
     * @throws ValidationException
     */
    private function validating(User $user): array
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
            "phone" => ["required", Rule::unique("users")->ignore($user->phone, "phone"), "numeric", "digits:11"],
            "personal_code" => ["required", Rule::unique("users")->ignore($user->personal_code, "personal_code"), "numeric", "digits:10"],
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
