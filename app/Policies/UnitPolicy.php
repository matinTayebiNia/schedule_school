<?php

namespace App\Policies;

use App\Models\Teacher;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Models\Unit;
use Illuminate\Auth\Access\Response;

class UnitPolicy
{

    /**
     * Determine whether the user can view the model.
     */
    public function viewUnit(Authenticatable $user, Unit $unit): bool
    {
        return $user instanceof Teacher && $user->id == $unit->teacher_id;
    }
}
