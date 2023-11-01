<?php

namespace App\Livewire\Admin\Student;

use Illuminate\Contracts\View\View;
use Livewire\Component;

class CreateStudent extends Component
{
    public function render(): View
    {
        $title = "ثبت دانش آموز";
        return view('admin.student.create', compact("title"))
            ->layout("admin.layouts.admin-layout");
    }
}
