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
        Schema::create('permissions', function (Blueprint $table) {
            $table->id();
            $table->string("name")->unique();
            $table->string("label")->nullable();
            $table->timestamps();
        });
        Schema::create("permission_user", function (Blueprint $table) {
            $table->unsignedBigInteger("permission_id");
            $table->unsignedBigInteger("user_id");
            $table->foreign("permission_id")->references("id")->on("permissions")
                ->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreign("user_id")->references("id")->on("users")
                ->cascadeOnDelete()->cascadeOnUpdate();
            $table->primary(["permission_id", "user_id"]);
        });

        Schema::create("role_user", function (Blueprint $table) {
            $table->unsignedBigInteger("role_id");
            $table->unsignedBigInteger("user_id");
            $table->foreign("role_id")->references("id")->on("roles")
                ->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreign("user_id")->references("id")->on("users")
                ->cascadeOnDelete()->cascadeOnUpdate();
            $table->primary(["role_id", "user_id"]);
        });

        Schema::create("permission_role", function (Blueprint $table) {
            $table->unsignedBigInteger("role_id");
            $table->unsignedBigInteger("permission_id");
            $table->foreign("role_id")->references("id")->on("roles")
                ->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreign("permission_id")->references("id")->on("permissions")
                ->cascadeOnDelete()->cascadeOnUpdate();
            $table->primary(["role_id", "permission_id"]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists("permission_role");
        Schema::dropIfExists("role_user");
        Schema::dropIfExists("permission_user");
        Schema::dropIfExists('permissions');
    }
};
