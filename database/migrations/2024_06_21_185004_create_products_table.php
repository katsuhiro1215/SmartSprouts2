<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_brand_id')->constrained();
            $table->foreignId('product_sub_category_id')->constrained();
            $table->string('name', 100)->comment('商品名');
            $table->string('slug', 50);
            $table->string('code', 50)->nullable()->comment('商品コード');
            $table->string('tags')->nullable();
            $table->text('short_descriptionp')->nullable()->comment('商品説明');
            $table->text('long_descriptionp')->nullable()->comment('商品概要');
            $table->decimal('normal_price', 8, 2);
            $table->decimal('discount_price', 8, 2)->nullable();
            $table->boolean('status')->default(true)->comment('販売中, 停止中');
            $table->integer('sort_order')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
