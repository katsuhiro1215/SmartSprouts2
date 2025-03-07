<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('notification_category_id')->constrained();
            $table->string('title', 100)->comment('タイトル');
            $table->string('slug', 100)->unique()->comment('スラッグ');
            $table->text('content')->comment('内容');
            $table->string('thumbnail')->nullable()->comment('サムネイル画像');
            $table->enum('type', ['お知らせ', '記事', 'ページ'])->default('記事')->comment('タイプ');
            $table->enum('target_role', ['全体', '管理者', '従業員', 'ユーザー', 'ゲスト'])->default('全体')->comment('公開対象');
            $table->foreignId('created_by')->nullable()->constrained('admins')->onDelete('set null');
            $table->foreignId('updated_by')->nullable()->constrained('admins')->onDelete('set null');
            $table->timestamp('published_at')->nullable()->comment('公開日時');
            $table->enum('status', ['公開', '下書き', '非公開'])->default('下書き')->comment('ステータス');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('notifications');
    }
};
