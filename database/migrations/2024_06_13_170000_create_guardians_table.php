<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('guardians', function (Blueprint $table) {
            $table->id();
            $table->string('lastname', 40)->comment('姓');
            $table->string('firstname', 40)->comment('名');
            $table->string('lastname_kana', 50)->comment('セイ');
            $table->string('firstname_kana', 50)->comment('メイ');
            $table->string('relationship', 20)->comment('保護者の続柄');
            $table->string('guardian_photo_path')->nullable()->comment('保護者写真');
            $table->date('birth')->nullable()->comment('生年月日');
            $table->string('gender', 10)->comment('性別');
            $table->string('mobile_number', 20)->comment('携帯番号');
            $table->string('company_name', 50)->nullable()->comment('勤務先');
            $table->string('company_phone_number', 20)->nullable()->comment('勤務先電話番号');
            $table->boolean('is_temporary')->default(true)->comment('仮会員');
            $table->foreignId('user_address_id')->nullable()->constrained();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('guardians');
    }
};
