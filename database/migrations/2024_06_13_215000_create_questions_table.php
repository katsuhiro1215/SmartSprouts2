<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('question_groups', function (Blueprint $table) {
            $table->id();
            $table->foreignId('questionnaire_id')->constrained();
            $table->string('group_name', 255)->comment('グループ名');
            $table->string('description', 2000)->comment('説明');
            $table->foreignId('parent_group_id')->nullable()->constrained('question_groups')->comment('親グループID');
            $table->foreignId('created_by')->nullable()->constrained('admins')->onDelete('set null');
            $table->foreignId('updated_by')->nullable()->constrained('admins')->onDelete('set null');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('questions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('questionnaire_id')->constrained();
            $table->string('question_text')->comment('質問内容');
            $table->enum('question_type', ['single_choice', 'multiple_choice', 'text', 'number', 'date', 'time', 'datetime'])->comment('質問タイプ');
            $table->foreignId('parent_question_id')->nullable()->constrained('questions')->comment('親質問ID');
            $table->foreignId('created_by')->nullable()->constrained('admins')->onDelete('set null');
            $table->foreignId('updated_by')->nullable()->constrained('admins')->onDelete('set null');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('questions');
        Schema::dropIfExists('question_groups');
    }
};
