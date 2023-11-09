<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                "name" => "create-teacher"
            ],
            [
                "name" => "see-teachers"
            ],
            [
                "name" => "see-teacher"
            ],
            [
                "name" => "delete-teacher"
            ],
            [
                "name" => "update-teacher"
            ],
            [
                "name" => "allow-to-set-permission"
            ],
            [
                "name" => "see-users"
            ],
            [
                "name" => "see-user"
            ],
            [
                "name" => "create-user"
            ],
            [
                "name" => "delete-user"
            ],
            [
                "name" => "update-user"
            ],
            // roles
            [
                "name" => "edit-role"
            ],
            [
                "name" => "delete-role"
            ],
            [
                "name" => "create-role"
            ],
            [
                "name" => "see-roles"
            ],
            [
                "name" => "see-role"
            ],
            //student
            [
                "name" => "create-student"
            ],
            [
                "name" => "see-students"
            ],
            [
                "name" => "see-student"
            ],
            [
                "name" => "delete-student"
            ],
            [
                "name" => "update-student"
            ],
            //lessen
            [
                "name" => "create-lessen"
            ],
            [
                "name" => "see-lessens"
            ],
            [
                "name" => "see-lessen"
            ],
            [
                "name" => "delete-lessen"
            ],
            [
                "name" => "update-lessen"
            ],
            //school
            [
                "name" => "create-school"
            ],
            [
                "name" => "see-schools"
            ],
            [
                "name" => "see-school"
            ],
            [
                "name" => "delete-school"
            ],
            [
                "name" => "update-school"
            ],
            // school class
            [
                "name" => "create-class"
            ],
            [
                "name" => "see-classes"
            ],
            [
                "name" => "delete-class"
            ],
            [
                "name" => "update-class"
            ],
            //units
            [
                "name" => "create-unite"
            ],
            [
                "name" => "see-unites"
            ],
            [
                "name" => "see-unite"
            ],
            [
                "name" => "delete-unite"
            ],
            [
                "name" => "update-unite"
            ],
        ];

        DB::table("permissions")->upsert($data, "name");

    }
}
