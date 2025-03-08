<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('bulk_recipients', function (Blueprint $table) {
            $table->id();
            $table->foreignId('bulk_email_id')->constrained()->onDelete('cascade')->comment('一斉送信メールID');
            $table->foreignId('user_id')->constrained()->onDelete('cascade')->comment('受信者のユーザーID');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('bulk_recipients');
    }
};
