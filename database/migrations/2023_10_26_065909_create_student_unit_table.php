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
        Schema::create('student_unit', function (Blueprint $table) {
            $table->unsignedBigInteger("student_id");
            $table->unsignedBigInteger("unit_id");
            $table->foreign("student_id")->references("id")->on("students")
                ->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreign("unit_id")->references("id")->on("units")
                ->cascadeOnUpdate()->cascadeOnDelete();
            $table->primary(["student_id", "unit_id"]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_unit');
    }
};
