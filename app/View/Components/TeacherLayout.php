<?php

namespace App\View\Components;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class TeacherLayout extends Component
{

    public function render(): View
    {
        return view('teacher.layouts.teacher-layout');
    }
}
