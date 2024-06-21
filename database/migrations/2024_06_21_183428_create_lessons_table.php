<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('lessons', function (Blueprint $table) {
            $table->id();
            $table->foreignId('store_id')->constrained();
            $table->string('name', 50)->comment('レッスン名');
            $table->text('description')->nullable()->comment('レッスン概要');
            $table->string('lesson_photo_path')->nullable()->comment('レッスン画像');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('lessons');
    }
};
