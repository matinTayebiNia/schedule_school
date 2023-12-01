<?php

namespace App\Livewire\Admin\Manger;

use App\Models\Manger;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\View\View;
use Livewire\Attributes\On;
use Livewire\Component;

class CreateManger extends Component
{

    public string $name = "";

    public string $family = "";

    public string $city = "";

    public string $state = "";

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

    /**
     * @throws AuthorizationException
     */
    public function mount()
    {
        $this->authorize('create-manger');

    }

    public function rules(): array
    {
        return [

        ];
    }

    public function messages(): array
    {
        return [

        ];
    }

    public function render():View
    {
        $title = "ثبت مدیر";

        return view('admin.manger.create', compact("title"))
            ->layout("admin.layouts.admin-layout");
    }

    /**
     * @throws AuthorizationException
     */
    public function save(): void
    {
        $this->authorize('create-manger');

        $data = $this->validate();

        Manger::create($data);

        session()->flash("success", "مدیر مورد نظر با موفقیت ویرایش شد");

        $this->redirect(route("admin.manger.index"));

    }

    /**
     * @param string $state
     */
    #[On("set_state")]
    public function setState(string $state): void
    {
        $this->state = $state;
    }

    /**
     * @param string $city
     */
    #[On("set_city")]
    public function setCity(string $city): void
    {
        $this->city = $city;
    }
}
