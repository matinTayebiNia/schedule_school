<?php

namespace App\Livewire\Admin\School;

use App\Models\School;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Rule;
use Livewire\Component;

class CreateSchool extends Component
{

    #[Rule("required", message: "نام مدرسه الزامی است")]
    #[Rule("min:3", message: "نام مدرسه باید بیشتر از 3 کاراتر باشد")]
    #[Rule("max:225", message: "نام مدرسه باید بیش ازحد مجاز")]
    public string $name;

    #[Rule("required", message: "کد مدرسه الزامی است")]
    #[Rule("digits:6", message: "کد مدرسه باید 6 عدد باشد")]
    #[Rule("unique:schools", message: "کد مدرسه تکراری میباشد")]
    public string $code;

    #[Rule("required", message: "ادرس مدرسه الزامی است")]
    #[Rule("min:3", message: "ادرس مدرسه باید بیشتر از 3 کاراتر باشد")]
    public string $address;

    public function render(): View
    {
        $title = "ثبت مدرسه جدید";
        return view('admin.school.create', compact("title"))
            ->layout("admin.layouts.admin-layout");
    }

    /**
     * @throws AuthorizationException
     */
    public function mount()
    {
        $this->authorize('create-school');

        $this->code = rand(100000, 999999);
    }

    /**
     * @throws AuthorizationException
     */
    public function save()
    {

        $this->authorize("create-school");

        $this->validate();

        School::create($this->all());

        session()->flash("success", "مدرسه مورد نظر با موفقیت ثبت شد");

        $this->redirect(route("admin.school.index"));

    }

}
