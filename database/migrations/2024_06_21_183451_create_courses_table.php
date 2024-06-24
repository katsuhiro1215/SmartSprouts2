<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('lesson_id')->constrained();
            $table->foreignId('course_category_id')->constrained();
            $table->string('name', 50)->comment('コース名');
            $table->text('description')->comment('コース概要');
            $table->string('course_photo_path')->nullable()->comment('コース画像');
            $table->datetime('application_start_date')->nullable()->comment('申込開始日');
            $table->datetime('application_end_date')->nullable()->comment('申込終了日');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('courses');
    }
};
