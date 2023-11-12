<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class AdminController extends Controller
{

    public function index(): View
    {
        // todo : change svg icon
        return view("admin.index");
    }

    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): \Illuminate\View\View
    {
        return view('admin.profile.edit', [
            'user' => $request->user(),
            "title"=>"ویرایش پروفایل"
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {

        $request->user()->fill($request->validated());

        $request->user()->save();

        return Redirect::route('admin.dashboard')->with('success', 'اطلاهات مورد نظر با موفقیت ویرایش شد ');

    }
}
