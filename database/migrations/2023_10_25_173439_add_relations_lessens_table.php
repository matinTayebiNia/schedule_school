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
        Schema::table('lessens', function (Blueprint $table) {
            $table->unsignedBigInteger("class_id");
            $table->unsignedBigInteger("teacher_id");
            $table->unsignedBigInteger("student_id");
            $table->foreign("class_id")->references("id")->on("school_classes")
                ->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreign("teacher_id")->references("id")->on("teachers")
                ->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreign("student_id")->references("id")->on("students")
                ->cascadeOnUpdate()->cascadeOnDelete();
            $table->primary(["class_id", "teacher_id", "student_id"]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('lessens', function (Blueprint $table) {
            $table->dropColumn("class_id");
            $table->dropColumn("teacher_id");
            $table->dropColumn("student_id");
        });
    }
};
