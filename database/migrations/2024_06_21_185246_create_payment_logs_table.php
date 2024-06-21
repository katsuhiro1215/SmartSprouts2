<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('payment_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id');
            $table->foreignId('fee_amount_id');
            $table->datetime('payment_date')->nullable()->comment('会計日時');
            $table->boolean('is_paid')->default(false)->comment('決済、未決済');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('payment_logs');
    }
};
