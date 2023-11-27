<?php

namespace App\Livewire\Admin\Lessen;

use App\Models\Lessen;
use App\Rules\LessonTimeAvailabilityRule;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Str;
use Livewire\Attributes\Rule;
use Livewire\Component;

class CreateLessen extends Component
{

    public string $name = "";

    public string $class_id="";

    public string $teacher_id="";

    public function rules(): array
    {
        return [
            "name" => ["required", "min:3", "max:225"],
            'class_id'   => [
                'required',
                'integer'],
            'teacher_id' => [
                'required',
                'integer'],
            'weekday'    => [
                'required',
                'integer',
                'min:1',
                'max:7'],
            'start_time' => [
                'required',
                new LessonTimeAvailabilityRule(),
                'date_format:' . config('panel.lesson_time_format')],
            'end_time'   => [
                'required',
                'after:start_time',
                'date_format:' . config('panel.lesson_time_format')],
        ];
    }

    public function messages()
    {
        return [

        ];
    }

    /**
     * @throws AuthorizationException
     */
    public function mount()
    {
        $this->authorize("create-lessen");
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
