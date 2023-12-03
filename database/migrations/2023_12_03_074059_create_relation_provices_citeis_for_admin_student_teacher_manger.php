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
        Schema::table('users', function (Blueprint $table) {
            $table->foreign("province_id")->references("id")->on("provinces")->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->foreign("city_id")->references("id")->on("cities")->cascadeOnUpdate()
                ->cascadeOnDelete();
        });
        Schema::table('schools', function (Blueprint $table) {
            $table->foreign("province_id")->references("id")->on("provinces")->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->foreign("city_id")->references("id")->on("cities")->cascadeOnUpdate()
                ->cascadeOnDelete();
        });
        Schema::table('teachers', function (Blueprint $table) {
            $table->foreign("province_id")->references("id")->on("provinces")->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->foreign("city_id")->references("id")->on("cities")->cascadeOnUpdate()
                ->cascadeOnDelete();
        });
        Schema::table('mangers', function (Blueprint $table) {
            $table->foreign("province_id")->references("id")->on("provinces")->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->foreign("city_id")->references("id")->on("cities")->cascadeOnUpdate()
                ->cascadeOnDelete();
        });
        Schema::table('students', function (Blueprint $table) {
            $table->foreign("province_id")->references("id")->on("provinces")->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->foreign("city_id")->references("id")->on("cities")->cascadeOnUpdate()
                ->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('relation_provices_citeis_for_admin_student_teacher_manger');
    }
};
