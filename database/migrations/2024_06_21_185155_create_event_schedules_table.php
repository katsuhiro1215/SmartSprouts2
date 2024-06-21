<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('event_schedules', function (Blueprint $table) {
            $table->id();
            $table->foreignId('event_id')->constrained();
            $table->foreignId('schedule_id')->constrained();
            $table->integer('capacity')->comment('定員');
            $table->boolean('status')->comment('開講、休講');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('event_schedules');
    }
};
