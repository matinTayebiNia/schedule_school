<?php

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
    User::create([
        'name' => "متین",
        'family' => "طیبی نیا",
        'phone' => "09024466648",
        'personal_code' => '0780963156',
        'address' => 'foo bar',
        'password' => Hash::make("matin321Q"),
        "is_staff" => 1,
        "is_superuser" => 1
    ]);
})->purpose('Display an inspiring quote');
