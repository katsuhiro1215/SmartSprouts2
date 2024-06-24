<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('course_categories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('store_id')->constrained();
            $table->string('name', 50)->comment('コースカテゴリー名');
            $table->text('description')->comment('コース概要');
            $table->string('course_photo_path')->nullable()->comment('コース画像');
            $table->date('start_date')->nullable()->comment('開始日');
            $table->date('end_date')->nullable()->comment('終了日');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('course_categories');
    }
};
