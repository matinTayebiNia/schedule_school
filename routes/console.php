<?php

use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Hash;

/*
|--------------------------------------------------------------------------
| Console Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of your Closure based console
| commands. Each Closure is bound to a command instance allowing a
| simple approach to interacting with each command's IO methods.
|
*/

Artisan::command('admin', function () {
    $user = User::create([
        'name' => "متین",
        'family' => "طیبی نیا",
        'phone' => "09024466648",
        'personal_code' => '0780963156',
        "state" => "خراسان رضوی",
        "city" => "سبزوار",
        'address' => 'میدان ابومسلم ',
        'password' => Hash::make("123456789"),
    ]);
    $role = Role::create([
        "name" => "super_admin",
        "label"=>"مدیر کل"
    ]);
    $role->permissions()->sync(Permission::all()->pluck("id")->toArray());
    $user->roles()->sync([$role->id]);
})->purpose('Display an inspiring quote');
