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
        Schema::create('lessens', function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->unsignedBigInteger("class_id");
            $table->unsignedBigInteger("teacher_id");
            $table->foreign("class_id")
                ->references("id")->on("school_classes")->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->foreign("teacher_id")
                ->references("id")->on("teachers")->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->unique(["teacher_id", "class_id"]);
            $table->enum("weekday", ["1", "2", "3", "4", "5", "6", "7"]);
            $table->time("start_time");
            $table->time("end_time");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lessens');
    }
};
