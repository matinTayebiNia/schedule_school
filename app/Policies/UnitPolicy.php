<?php

namespace App\Policies;

use App\Models\Teacher;
use App\Models\Unit;
use Illuminate\Auth\Access\Response;

class UnitPolicy
{

    /**
     * Determine whether the user can view the model.
     */
    public function view(Teacher $user, Unit $unit): bool
    {
        return $user->id == $unit->teacher_id;
    }
}
