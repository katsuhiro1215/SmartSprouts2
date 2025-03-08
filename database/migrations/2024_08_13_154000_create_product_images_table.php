<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('product_images', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained()->onDelete('cascade');
            $table->string('product_photo_path')->comment('商品画像');
            $table->string('product_photo_name')->nullable()->comment('商品画像名');
            $table->string('description')->nullable()->comment('商品画像概要');
            $table->boolean('is_thumbnail')->default(false)->comment('サムネイル画像かどうか');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('product_images');
    }
};
