<?php

namespace App\Livewire\Admin\Lessen;

use App\Models\Lessen;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Str;
use Livewire\Attributes\Rule;
use Livewire\Component;

class CreateLessen extends Component
{
    #[Rule("required", message: "نام الزامی میباشد")]
    #[Rule("min:3", message: "مقدار وارد شده باید بیشتر از 3 کاراتر باشد")]
    #[Rule("max:225", message: "مقدار وارد شده بیش از حد مجاز ")]
    public string $name = "";

    #[Rule("required", message: "کد الزامی میباشد")]
    #[Rule("digits:6", message: "مقدار وارد شده باید 6 عدد باشد ")]
    #[Rule("unique:lessens", message: "کد درس تکراری میباشد")]
    #[Rule("numeric", message: "کد درس باید عدد باشد")]
    public string $code = "";

    /**
     * @throws AuthorizationException
     */
    public function mount()
    {
        $this->authorize("create-lessen");

        $this->code=rand(100000,999999);
    }

    public function render(): View
    {
        $title = "ساخت درس";
        return view('admin.lessen.create', compact('title'))
            ->layout("admin.layouts.admin-layout");
    }

    /**
     * @throws AuthorizationException
     */
    public function save()
    {
        $this->authorize("create-lessen");

        $this->validate();

        Lessen::create($this->all());

        session()->flash("success", "درس مورد نظر با موفقیت ثبت شد ");

        $this->redirect(route("admin.lessen.index"));
    }
}
