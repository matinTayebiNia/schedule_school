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
        Schema::table('students', function (Blueprint $table) {
            $table->unsignedBigInteger("school_id")->after("id");
            $table->unsignedBigInteger("class_id")->after("school_id");
            $table->foreign("school_id")
                ->references('id')
                ->on('schools')->cascadeOnDelete()
                ->cascadeOnUpdate();
            $table->foreign("class_id")
                ->references('id')
                ->on('school_classes')->cascadeOnDelete()
                ->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('students', function (Blueprint $table) {
            $table->dropColumn("school_id");
            $table->dropColumn("class_id");
        });
    }
};
