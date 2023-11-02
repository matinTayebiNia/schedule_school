<?php

namespace App\Livewire\Admin\School;

use App\Models\School;
use Illuminate\Auth\Access\AuthorizationException;
use Livewire\Attributes\Rule;
use Livewire\Component;

class EditSchool extends Component
{
    public int $school_id;

    #[Rule("required", message: "نام مدرسه الزامی است")]
    #[Rule("min:3", message: "نام مدرسه باید بیشتر از 3 کاراتر باشد")]
    #[Rule("max:225", message: "نام مدرسه باید بیش ازحد مجاز")]
    public string $name;

    #[Rule("required", message: "ادرس مدرسه الزامی است")]
    #[Rule("min:3", message: "ادرس مدرسه باید بیشتر از 3 کاراتر باشد")]
    public string $address;

    public function render()
    {

        $title = "ویرایش مدرسه";
        return view('admin.school.edit', compact("title"))
            ->layout("admin.layouts.admin-layout");
    }

    /**
     * @throws AuthorizationException
     */
    public function mount(School $school)
    {
        $this->authorize("edit-school");

        $this->school_id = $school->id;

        $this->name = $school->name;

        $this->address = $school->address;
    }

    /**
     * @param School $school
     * @throws AuthorizationException
     */
    public function update(School $school)
    {
        $this->authorize("edit-school");

        $data = $this->validate();

        $school->update($data);

        session()->flash("success", "مدرسه مورد نظر با موفقیت ویرایش شد ");

        $this->redirect(route("admin.school.index"));
    }

}
