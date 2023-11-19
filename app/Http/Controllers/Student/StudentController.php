<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileUpdateRequest;
use App\Http\Requests\student\PasswordRequest;
use App\Http\Requests\student\profileRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\Rules\Password;
use Illuminate\View\View;

class StudentController extends Controller
{
    /**
     * @return View
     */
    public function index(): View
    {
        return view("student.index");
    }

    /**
     * @param Request $request
     * @return View
     */
    public function edit(Request $request): View
    {
        return view('student.profile.edit', [
            'user' => $request->user("student"),
            "title" => "ویرایش پروفایل"
        ]);
    }

    /**
     * @param profileRequest $request
     * @return RedirectResponse
     */
    public function update(profileRequest $request): RedirectResponse
    {
        $request->user("student")->fill($request->validated());

        $request->user("student")->save();

        return Redirect::route('student.dashboard')->with('success', 'اطلاهات مورد نظر با موفقیت ویرایش شد ');

    }

    public function password(PasswordRequest $request): RedirectResponse
    {

        $request->user("student")->update([
            "password" => Hash::make($request->input("password"))
        ]);

        return Redirect::route('student.dashboard')->with('success', 'اطلاهات مورد نظر با موفقیت ویرایش شد ');
    }
}
