<?php

namespace App\Livewire\Admin\Lessen;

use App\Models\Lessen;
use App\Models\Student;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;
use Livewire\Component;

class EditLessen extends Component
{
    public int $lessen_id;

    public string $name = "";

    public string $code = "";

    /**
     * @throws AuthorizationException
     */
    public function mount(Lessen $lessen)
    {
        $this->authorize("edit-lessen");

        $this->lessen_id = $lessen->id;

        $this->name = $lessen->name;

        $this->code = $lessen->code;

    }

    public function render()
    {
        $title = "ویرایش درس";
        return view('admin.lessen.edit', compact('title'))
            ->layout("admin.layouts.admin-layout");
    }

    /**
     * @param Lessen $lessen
     * @throws AuthorizationException
     * @throws ValidationException
     */
    public function update(Lessen $lessen)
    {

        $this->authorize("edit-lessen");

        $data = $this->validating($lessen);

        $lessen?->update($data);

        session()->flash("success", "درس مورد نظر با موفقیت ویرایش شد ");

        $this->redirect(route("admin.lessen.index"));

    }

    /**
     * @param Lessen $lessen
     * @return array
     * @throws ValidationException
     */
    private function validating(Lessen $lessen): array
    {
        return Validator::make(
            [
                "name" => $this->name, "code" => $this->code,
            ]
            , [
            "name" => ["required", "min:3", "max:200"],
            "code" => ["required", Rule::unique("lessens")->ignore($lessen->code,
                "code"), "numeric","digits:6"],
        ],
            [
                "name.required" => 'نام وارد نشده',
                "name.min" => "نام باید بیشتر از 3 کاراتر باشد",
                "name.max" => 'مقدار نام بیشتر از حد مجاز است',
                "code.required" => "کد درس وارد نشده",
                "code.numeric" => 'کد درس باید عدد باشد',
                "code.unique" => 'کد درس تکراری میباشد',
                "code.digit" => 'مقدار وارد شده باید 6 عدد باشد',
            ])->validate();
    }
}
