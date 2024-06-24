<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('student_evalutions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained();
            $table->foreignId('admin_id')->constrained();
            $table->foreignId('course_id')->constrained();
            $table->string('rating')->comment('評価');
            $table->text('comment')->nullable()->comment('従業員へのコメントやフィードバック');
            $table->datetime('evaluation_date')->comment('評価を行った日付');
            $table->string('status')->default('承認待ち')->comment('承認、承認待ち');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('student_evalutions');
    }
};
