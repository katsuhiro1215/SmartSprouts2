<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('welcome_settings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('organization_id')->constrained();
            $table->string('title')->nullable()->comment('タイトル');
            $table->string('description')->nullable()->comment('キャッチフレーズ');
            $table->string('welcome_photo_path')->nullable()->comment('トップ画像');
            $table->text('rule')->nullable()->comment('会則');
            $table->text('privacy_policy')->nullable()->comment('プライバシーポリシー');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('welcome_settings');
    }
};
