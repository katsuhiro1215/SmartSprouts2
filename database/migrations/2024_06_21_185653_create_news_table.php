<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('news', function (Blueprint $table) {
            $table->id();
            $table->foreignId('news_category_id')->constrained();
            $table->string('title', 100)->comment('ニュースタイトル');
            $table->string('slug', 100);
            $table->text('content')->comment('ニュース内容');
            $table->string('thumbnail')->nullable()->comment('サムネイル画像');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('news');
    }
};
