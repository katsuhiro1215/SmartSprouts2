<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('contact_replies', function (Blueprint $table) {
            $table->id();
            $table->foreignId('contact_id')->constrained()->onDelete('cascade')->comment('お問い合わせID');
            $table->foreignId('admin_id')->nullable()->constrained()->nullOnDelete()->comment('管理者ID');
            $table->string('reply_title')->comment('返信タイトル');
            $table->text('reply_content')->comment('返信内容');
            $table->boolean('is_sent')->default(false)->comment('送信済みフラグ');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('contact_replies');
    }
};
