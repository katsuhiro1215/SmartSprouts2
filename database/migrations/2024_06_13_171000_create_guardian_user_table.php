<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('guardian_user', function (Blueprint $table) {
            $table->id();
            $table->foreignId('guardian_id')->constrained();
            $table->foreignId('user_id')->constrained();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('guardian_user');
    }
};
