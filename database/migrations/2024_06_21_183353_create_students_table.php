<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->string('lastname', 40)->comment('姓');
            $table->string('firstname', 40)->comment('名');
            $table->string('lastname_kana', 50)->comment('セイ');
            $table->string('firstname_kana', 50)->comment('メイ');
            $table->string('student_photo_path')->nullable()->comment('ユーザー写真');
            $table->date('birth')->comment('生年月日');
            $table->string('gender', 10)->comment('性別');
            $table->string('blood', 10)->nullable()->comment('血液型');
            $table->string('zipcode', 10)->comment('郵便番号');
            $table->string('address1', 20)->comment('都道府県名');
            $table->string('address2', 30)->comment('市区町村名');
            $table->string('address3', 50)->comment('町域名');
            $table->string('address4', 100)->comment('それ以降の住所');
            $table->string('phone_number', 20)->nullable()->comment('電話番号');
            $table->string('mobile_number', 20)->comment('緊急連絡先');
            $table->string('mobile_number_relationship', 20)->comment('緊急連絡先の続柄');
            $table->text('personal_history')->nullable()->comment('既往歴');
            $table->string('member_no')->nullable()->comment('会員ID');
            $table->string('membership_status', 20)->default('非会員')->comment('会員, 非会員');
            $table->string('serial_no')->nullable()->comment('シリアルナンバー');
            $table->boolean('permission_photo')->default(false)->comment('写真使用許可');
            $table->boolean('permission_dm')->default(false)->comment('DM発送許可');
            $table->string('school_year', 20)->nullable()->comment('学年');
            $table->text('remarks')->nullable()->comment('備考欄');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
