<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
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
     * @param ProfileUpdateRequest $request
     * @return RedirectResponse
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user("student")->fill($request->validated());

        $request->user("student")->save();

        return Redirect::route('student.dashboard')->with('success', 'اطلاهات مورد نظر با موفقیت ویرایش شد ');

    }
}
