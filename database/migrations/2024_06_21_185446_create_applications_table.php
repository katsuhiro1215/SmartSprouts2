<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('applications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained();
            $table->foreignId('course_id')->constrained();
            $table->enum('course_type', ['体験教室', '短期教室'])->default('体験教室')->comment('体験教室、短期教室');
            $table->datetime('application_date')->comment('申込日');
            $table->date('cancel_date')->nullable()->comment('キャンセル日');
            $table->string('status')->default('承認待ち')->comment('承認済み、承認待ち、キャンセル');
            $table->text('remarks')->nullable()->comment('備考欄');
            $table->boolean('is_notified')->default(false);
            $table->boolean('is_paid')->default(false)->comment('決済、未決済');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('applications');
    }
};
