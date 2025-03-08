<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('bulk_emails', function (Blueprint $table) {
            $table->id();
            $table->string('subject')->comment('メールの件名');
            $table->text('body')->comment('メールの内容');
            $table->enum('status', ['未送信', '送信済'])->default('未送信')->comment('ステータス');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('bulk_emails');
    }
};
