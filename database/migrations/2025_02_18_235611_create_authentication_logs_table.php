<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('authentication_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
            $table->string('ip_address');
            $table->string('user_agent');
            $table->string('device')->nullable();
            $table->string('platform')->nullable();
            $table->string('browser')->nullable();
            $table->string('host')->nullable();
            $table->string('port')->nullable();
            $table->string('protocol')->nullable();
            $table->string('event'); // 'login' or 'logout'
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('authentication_logs');
    }
};
