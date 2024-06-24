<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('questionnaries', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100)->comment('質問名');
            $table->text('description')->comment('質問内容');
            $table->boolean('status')->default(false)->comment('公開、非公開');
            $table->datetime('start_date')->nullable()->comment('公開開始日時');
            $table->datetime('end_date')->nullable()->comment('公開終了日時');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('questionnaries');
    }
};
