<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('system_settings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('owner_id')->constrained();
            $table->string('name', 50)->comment('システム名');
            $table->text('description')->nullable()->comment('システム概要');
            $table->text('version')->nullable()->comment('バージョン');
            $table->text('frontend')->nullable()->comment('フロントエンド');
            $table->text('backend')->nullable()->comment('バックエンド');
            $table->string('system_photo_path')->nullable()->comment('システム写真');
            $table->string('system_logo_path')->nullable()->comment('システムロゴ');
            $table->string('website')->nullable()->comment('URL');
            $table->string('facebook')->nullable()->comment('Facebook URL');
            $table->string('twitter')->nullable()->comment('Twitter URL');
            $table->string('instagram')->nullable()->comment('Instagram URL');
            $table->string('youtube')->nullable()->comment('YouTube URL');
            $table->string('line')->nullable()->comment('LINE URL');
            $table->date('opening_date')->nullable()->comment('開設日');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('system_settings');
    }
};
