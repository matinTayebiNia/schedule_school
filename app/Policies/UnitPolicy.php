<?php

namespace App\Policies;

use App\Models\Student;
use App\Models\Teacher;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Models\Unit;
use Illuminate\Auth\Access\Response;

class UnitPolicy
{

    /**
     * Determine whether the user can view the model.
     */
    public function view_teacher_unit(Authenticatable $user, Unit $unit): bool
    {
        return $user instanceof Teacher && $user->id == $unit->teacher_id;
    }

    public function view_unit_student(Authenticatable $user, Unit $unit): bool
    {
        return $user instanceof Student && !! $user->units()->where("unit_id", $unit->id)->first();
    }
}
