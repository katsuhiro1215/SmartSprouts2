<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('student_enrollment_goals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('store_id');
            $table->date('goal_date');
            $table->integer('goal');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('student_enrollment_goals');
    }
};
