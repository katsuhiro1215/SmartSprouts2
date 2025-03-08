<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('product_coupons', function (Blueprint $table) {
            $table->id();
            $table->string('name')->comment('クーポン名');
            $table->string('code')->comment('クーポンコード');
            $table->integer('discount');
            $table->string('validity');
            $table->boolean('status')->default(1);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('coupons');
    }
};
