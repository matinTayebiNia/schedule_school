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
        Schema::create("units", function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("class_id");
            $table->unsignedBigInteger("lessen_id");
            $table->unsignedBigInteger("teacher_id");
            $table->foreign("class_id")->references("id")->on("school_classes")
                ->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreign("teacher_id")->references("id")->on("teachers")
                ->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreign("lessen_id")->references("id")->on("lessens")
                ->cascadeOnUpdate()->cascadeOnDelete();
            $table->unique(["teacher_id", "lessen_id","class_id"]);
            $table->enum("weekday", ["1", "2", "3", "4", "5", "6", "7"]);
            $table->time("start_time");
            $table->time("end_time");
            $table->integer("student_limit");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists("pivot_table_student");
    }
};
