<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('rooms', function (Blueprint $table) {
            $table->id();
            $table->foreignId('course_id')->constrained();
            $table->foreignId('schedule_id')->constrained();
            $table->string('name')->comment('班名');
            $table->text('description')->nullable()->comment('班概要');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('rooms');
    }
};
