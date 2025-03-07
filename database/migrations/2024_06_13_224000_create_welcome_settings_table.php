<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('welcome_settings', function (Blueprint $table) {
            $table->id();
            $table->string('name')->comment('設定名');
            $table->text('value')->nullable()->comment('設定値');
            $table->string('type')->default('text')->comment('設定のタイプ (text, file, json など)');
            $table->foreignId('created_by')->nullable()->constrained('admins')->onDelete('set null');
            $table->foreignId('updated_by')->nullable()->constrained('admins')->onDelete('set null');
            $table->timestamps();
        });

    }

    public function down(): void
    {
        Schema::dropIfExists('welcome_settings');
    }
};
