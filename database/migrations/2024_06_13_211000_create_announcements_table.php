<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('announcements', function (Blueprint $table) {
            $table->id();
            $table->foreignId('course_category_id')->constrained();
            $table->string('name', 50)->comment('告知名');
            $table->string('announcement_photo_path')->nullable()->comment('告知画像');
            $table->text('description')->comment('告知内容');
            $table->date('start_date')->comment('開始日');
            $table->date('end_date')->comment('終了日');
            $table->datetime('announcement_start_date')->comment('告知開始日');
            $table->datetime('announcement_end_date')->comment('告知終了日');
            $table->boolean('status')->default(false)->comment('公開、非公開');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('announcements');
    }
};
