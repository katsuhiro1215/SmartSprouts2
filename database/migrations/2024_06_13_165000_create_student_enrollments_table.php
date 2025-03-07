<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('student_enrollments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained();
            $table->datetime('application_date')->comment('申込日');
            $table->datetime('enrollment_date')->nullable()->comment('入会日');
            $table->string('selected_days')->nullable()->comment('希望する曜日');
            $table->string('preferred_days')->nullable()->comment('メインの曜日');
            $table->string('status', 20)->default('承認待ち')->comment('承認済み、承認待ち、キャンセル');
            $table->boolean('is_paid')->default(false)->comment('決済、未決済');
            $table->boolean('is_notified')->default(false);
            $table->date('cancel_date')->nullable()->comment('キャンセル日');
            $table->date('suspension_start_date')->nullable()->comment('休会開始日');
            $table->date('suspension_end_date')->nullable()->comment('休会終了日');
            $table->string('suspension_reason')->nullable()->comment('休会理由');
            $table->date('withdrawal_date')->nullable()->comment('退会日');
            $table->string('withdrawal_reason')->nullable()->comment('退会理由');
            $table->text('remarks')->nullable()->comment('備考欄');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('student_enrollments');
    }
};
