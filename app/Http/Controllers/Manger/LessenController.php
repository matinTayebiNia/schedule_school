<?php

namespace App\Http\Controllers\Manger;

use App\Http\Controllers\Controller;
use App\Http\Requests\Manger\Lessen\CreateLessonRequest;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;

class LessenController extends Controller
{
    /**
     * Display a listing of the resource.
     * @throws AuthorizationException
     */
    public function index()
    {
        $this->authorize("see-lessens");
    }

    /**
     * Show the form for creating a new resource.
     * @throws AuthorizationException
     */
    public function create()
    {
        $this->authorize("create-lessen");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateLessonRequest $request)
    {
        //
    }



    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @throws AuthorizationException
     */
    public function destroy(string $id)
    {
        $this->authorize("delete-lessen");
    }
}
