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
            $table->string('name', 50)->comment('システム名');
            $table->text('description', 1000)->comment('システム概要');
            $table->string('version', 20)->comment('バージョン');
            $table->text('frontend', 1000)->comment('フロントエンド');
            $table->text('backend', 1000)->comment('バックエンド');
            $table->string('system_photo_path')->nullable()->comment('システム写真');
            $table->string('system_logo_path')->nullable()->comment('システムロゴ');
            $table->string('website')->nullable()->comment('URL');
            $table->string('facebook')->nullable()->comment('Facebook URL');
            $table->string('twitter')->nullable()->comment('Twitter URL');
            $table->string('instagram')->nullable()->comment('Instagram URL');
            $table->string('youtube')->nullable()->comment('YouTube URL');
            $table->string('line')->nullable()->comment('LINE URL');
            $table->date('opening_date')->comment('開設日またはリリース日');
            $table->foreignId('created_by')->nullable()->constrained('admins')->onDelete('set null');
            $table->foreignId('updated_by')->nullable()->constrained('admins')->onDelete('set null');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('system_settings');
    }
};
