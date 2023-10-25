<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string("family");
            $table->string('phone', "11")->unique();
            $table->string("personal_code", "10")->unique();
            $table->string('password');
            $table->string("address");
            $table->string("profile_image")->nullable();
            $table->boolean("is_staff")->default(1);
            $table->boolean("is_superuser")->default(0);
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
