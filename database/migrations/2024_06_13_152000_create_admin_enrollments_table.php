<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('admin_enrollments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('admin_id')->constrained();
            $table->date('enrollment_date')->nullable()->comment('入社日');
            $table->boolean('is_notified')->default(false);
            $table->date('suspension_start_date')->nullable()->comment('休職開始日');
            $table->date('suspension_end_date')->nullable()->comment('休職終了日');
            $table->string('suspension_reason')->nullable()->comment('休会理由');
            $table->date('withdrawal_date')->nullable()->comment('退職日');
            $table->string('withdrawal_reason')->nullable()->comment('退会理由');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('admin_enrollments');
    }
};
