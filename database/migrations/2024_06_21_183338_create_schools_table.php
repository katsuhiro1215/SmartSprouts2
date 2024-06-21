<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('schools', function (Blueprint $table) {
            $table->id();
            $table->foreignId('school_category_id')->constrained();
            $table->string('name', 50)->comment('学校名');
            $table->string('zipcode', 10)->nullable()->comment('郵便番号');
            $table->string('address1', 20)->nullable()->comment('都道府県名');
            $table->string('address2', 30)->nullable()->comment('市区町村名');
            $table->string('address3', 50)->nullable()->comment('町域名');
            $table->string('address4', 100)->nullable()->comment('それ以降の住所');
            $table->string('phone_number', 20)->nullable()->comment('連絡先');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('schools');
    }
};