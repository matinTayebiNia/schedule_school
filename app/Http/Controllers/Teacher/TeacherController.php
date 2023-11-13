<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Http\Requests\Teacher\Profile\PasswordTecherRequest;
use App\Http\Requests\Teacher\Profile\UpdateTecherRequest;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\Rules\Password;

class TeacherController extends Controller
{
    public function index(): View
    {
        return view("teacher.index");
    }

    public function edit(Request $request): View
    {
        return view('teacher.profile.edit', [
            'user' => $request->user("teacher"),
            "title" => "ویرایش پروفایل"
        ]);
    }

    public function update(UpdateTecherRequest $request): RedirectResponse
    {
        $request->user("teacher")->fill($request->validated());

        $request->user("teacher")->save();

        return Redirect::route('teacher.dashboard')->with('success', 'اطلاهات مورد نظر با موفقیت ویرایش شد ');
    }

    public function password(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'current_password' => ['required', 'current_password'],
            'password' => ['required', Password::defaults(), 'confirmed'],
        ]);

        $request->user("teacher")->update([
            "password" => Hash::make($data["password"])
        ]);

        return Redirect::route('teacher.dashboard')->with('success', 'اطلاهات مورد نظر با موفقیت ویرایش شد ');
    }
}
