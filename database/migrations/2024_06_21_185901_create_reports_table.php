<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('reports', function (Blueprint $table) {
            $table->id();
            $table->string('title')->comment('レポートのタイトル');
            $table->text('description')->nullable()->comment('レポートの説明');
            $table->string('type')->comment('レポートの種類');
            $table->text('file_path')->comment('PDFファイルのパス');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('reports');
    }
};
