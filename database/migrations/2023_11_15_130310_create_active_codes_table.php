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
        Schema::create('active_codes', function (Blueprint $table) {
            $table->id();
            $table->string("code");
            $table->bigInteger("userable_id");
            $table->string('userable_type');
            $table->unique(["code", "userable_id"]);
            $table->timestamp('expired_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('active_codes');
    }
};
