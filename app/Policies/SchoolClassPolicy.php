<?php

namespace App\Policies;

use App\Models\SchoolClass;
use App\Models\Manger;
use Illuminate\Auth\Access\Response;

class SchoolClassPolicy
{

    /**
     * Determine whether the user can view the model.
     */
    public function view_schools(Manger $user, SchoolClass $schoolClass): bool
    {
        return $user->school_id == $schoolClass->id;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create_school(Manger $user,SchoolClass $schoolClass): bool
    {
        return $user->school_id == $schoolClass->id;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update_school(Manger $user, SchoolClass $schoolClass): bool
    {
        return $user->school_id == $schoolClass->id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete_school(Manger $user, SchoolClass $schoolClass): bool
    {
        return $user->school_id == $schoolClass->id;
    }


}
