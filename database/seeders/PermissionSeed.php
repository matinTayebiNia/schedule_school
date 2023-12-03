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
                "name" => "create-manger"
            ],
            [
                "name" => "see-mangers"
            ],
            [
                "name" => "see-manger"
            ],
            [
                "name" => "delete-manger"
            ],
            [
                "name" => "update-manger"
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

        ];

        DB::table("permissions")->upsert($data, "name");

    }
}
