<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('school_student', function (Blueprint $table) {
            $table->id();
            $table->foreignId('school_id')->constrained();
            $table->foreignId('student_id')->constrained();
            $table->string('grade', 20)->nullable()->comment('1年', '2年', '3年', '4年', '5年', '6年');            
            $table->string('status', 20)->comment('在籍', '休学', '退学', '卒業');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('school_student');
    }
};
