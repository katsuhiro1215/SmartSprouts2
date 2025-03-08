<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('product_brands', function (Blueprint $table) {
            $table->id();
            $table->string('name')->comment('商品ブランド名');
            $table->string('slug')->comment('スラッグ');
            $table->string('description')->nullable()->comment('説明文');
            $table->string('brand_photo_path')->nullable()->comment('ブランド画像');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('product_brands');
    }
};
