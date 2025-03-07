<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('questionnaires', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255)->comment('質問名');
            $table->text('description', 2000)->comment('質問内容');
            $table->enum('status', ['draft', 'review', 'published', 'paused', 'archived'])->default('draft')->comment('公開状態');
            $table->datetime('publish_at')->nullable()->comment('公開予定日時');
            $table->datetime('unpublish_at')->nullable()->comment('公開終了予定日時');
            $table->foreignId('created_by')->nullable()->constrained('admins')->onDelete('set null');
            $table->foreignId('updated_by')->nullable()->constrained('admins')->onDelete('set null');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('questionnaires');
    }
};
