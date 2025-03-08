<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('admin_widgets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('admin_id')->constrained()->onDelete('cascade');
            $table->foreignId('widget_id')->constrained()->onDelete('cascade');
            $table->string('type')->comment('ウィジェットのタイプ');
            $table->json('settings')->comment('ウィジェットの設定');
            $table->integer('position')->comment('表示順');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('admin_widgets');
    }
};
