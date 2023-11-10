<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('classroom_lecture', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\Classroom::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(\App\Models\Lecture::class)->constrained()->cascadeOnDelete();
            $table->integer('position')->default(100);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('table_classroom_lecture');
    }
};
