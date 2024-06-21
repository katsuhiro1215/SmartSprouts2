<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('contacts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete()->comment('ユーザーID（外部ユーザーの場合はnull）');
            $table->string('name')->comment('名前');
            $table->string('email')->comment('メールアドレス');
            $table->string('subject')->comment('お問い合わせの件名');
            $table->text('body')->comment('お問い合わせの内容');
            $table->enum('status', ['未読', '既読'])->default('未読')->comment('ステータス');
            $table->enum('flag', ['重要', 'マーク'])->nullable()->comment('フラグ');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('contacts');
    }
};
