<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('event_applications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained();
            $table->foreignId('event_id')->constrained();
            $table->datetime('application_date')->comment('申込日');
            $table->datetime('cancel_date')->nullable()->comment('キャンセル日');
            $table->string('status')->nullable()->comment('申込中、承認済み、キャンセル');
            $table->text('remarks')->nullable()->comment('備考欄');
            $table->boolean('is_notified')->default(false);
            $table->boolean('is_paid')->default(false)->comment('決済、未決済');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('event_applications');
    }
};
