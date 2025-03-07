<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('store_schedules', function (Blueprint $table) {
            $table->id();
            $table->foreignId('store_id')->constrained();
            $table->dateTime('start_date');
            $table->dateTime('end_date');
            $table->enum('day_of_week', ['月曜日', '火曜日', '水曜日', '木曜日', '金曜日', '土曜日', '日曜日'])->comment('曜日');
            $table->boolean('is_open')->default(true)->comment('営業日かどうか');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('store_schedules');
    }
};
