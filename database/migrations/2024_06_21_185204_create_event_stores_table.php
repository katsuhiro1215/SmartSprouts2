<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('event_stores', function (Blueprint $table) {
            $table->id();
            $table->foreignId('event_id')->constrained();
            $table->foreignId('store_id')->constrained();
            $table->boolean('status')->comment('参加、未参加');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('event_stores');
    }
};
