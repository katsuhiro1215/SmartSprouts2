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
            $table->foreignId('lesson_id')->constrained();
            $table->enum('type', ['一般教室', '体験教室', '短期教室', 'イベント'])->comment('コースカテゴリータイプ');
            $table->string('name', 50)->comment('コースカテゴリー名');
            $table->text('description', 1000)->comment('コース概要');
            $table->string('course_category_photo_path')->nullable()->comment('コース画像');
            $table->boolean('status')->default(false)->comment('公開、非公開');
            $table->date('start_date')->comment('開始日');
            $table->date('end_date')->comment('終了日');
            $table->foreignId('created_by')->nullable()->constrained('admins')->onDelete('set null');
            $table->foreignId('updated_by')->nullable()->constrained('admins')->onDelete('set null');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('lesson_id')->constrained();
            $table->foreignId('course_category_id')->constrained();
            $table->string('name', 50)->comment('コース名');
            $table->text('description',1000)->comment('コース概要');
            $table->string('course_photo_path')->nullable()->comment('コース画像');
            $table->boolean('status')->default(false)->comment('公開、非公開');
            $table->datetime('application_start_date')->nullable()->comment('申込開始日');
            $table->datetime('application_end_date')->nullable()->comment('申込終了日');
            $table->smallInteger('sort_no')->default(0)->comment('表示順');
            $table->foreignId('created_by')->nullable()->constrained('admins')->onDelete('set null');
            $table->foreignId('updated_by')->nullable()->constrained('admins')->onDelete('set null');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('courses');
        Schema::dropIfExists('course_categories');
    }
};
